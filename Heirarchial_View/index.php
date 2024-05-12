<?php
require_once 'Database.php';

$db = new Database();
$conn = $db->connect();

$sql = "SELECT * FROM members";
$stmt = $conn->query($sql);

$arr = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $arr[$row['id']]['name'] = $row['name'];
    $arr[$row['id']]['parent_id'] = $row['parent_id'];
}
echo '<div id="member-list">';
buildTreeView($arr, 0);
echo '</div>';

function buildTreeView($arr, $parent, $level = 0, $prelevel = -1) {

    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $prelevel) {
                echo "<ul>"; //we can use <ol> for orderd list
            }
            if ($level == $prelevel) {
                echo "</li>";
            }
            // echo "<li>" . $data['name'];
            echo "<li data-identifier='" . $data['name'] . "'>" . $data['name'];
            if ($level > $prelevel) {
                $prelevel = $level;
            }
            $level++;
            
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }
    if ($level == $prelevel) {
        echo "</li></ul>"; //we can use </ol> to end orderd list
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Member List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Member List</h1>

    <button id="addMemberButton">Add Member</button>
</body>
</html>

<script>
    $(document).ready(function() {
       $('#addMemberButton').click(function(e) {
        e.preventDefault();

            fetch('http://localhost/Heirarchial_View/getMembers.php')
                .then(response => response.json())
                .then(data => {
                    
                    const options = data.options; 

                    var  name='';
                    var  selectValue='';
                Swal.fire({
                title: 'Add Member',
                html:
                    '<select id="select-box" class="swal2-input">' +
                    options.map(option => `<option value="${option.name}">${option.name}</option>`).join('') +
                    '</select>' +
                    '<input type=text id="swal-input2" class="swal2-input" >',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                        name = document.getElementById('swal-input2').value;
                        selectValue = document.getElementById('select-box').value;

                        if (!name) {
                            Swal.showValidationMessage('Name cannot be empty.');
                            return false;
                        }
                        if (!/^[a-zA-Z\s]*$/.test(name)) {
                            Swal.showValidationMessage('Name must contain only letters and spaces.');
                            return false;
                        }
                        

                        return $.ajax({
                            type: 'POST',
                            url: 'AddMember.php', 
                            data: {
                                name: name,
                                selectValue: selectValue
                            },
                            success: function (response) {
                                Swal.fire('Submitted', 'Data saved successfully!', 'success');
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('Error', 'Failed to save data. Please try again.', 'error');
                            }
                        });
                    },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                    title: `Record Saved`
                    })
                    
                    
                    var parentMemberElement = $('#member-list').find(`li[data-identifier="${selectValue}"]`);
                        parentMemberElement.append(`
                        <ul><li>${name}</li></ul>
                    `);

                }
                })

            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        });
    }); 
</script>
