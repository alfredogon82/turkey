<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfredo González Turkey Challenge</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="display-4 text-center">Alfredo González - Turkey Challenge</h1>
        <div class="d-flex justify-content-between mb-3">
            <form id="exportCSVForm" action="api.php" method="get" style="display: inline;">
                <input type="hidden" name="action" value="exportToCSV">
                <button type="submit" class="btn btn-primary">Report</button>
            </form>
            <button id="add_turkey" class="btn btn-success">Add Turkey</button>
        </div>
        <div id="warning" class="alert alert-warning d-none" role="alert">
            Connection to the database is not working.
        </div>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Age</th>
                    <th scope="col">Status</th>
                    <th scope="col">Color</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Status Image</th>
                </tr>
            </thead>
            <tbody id="turkeyTableBody">
                <!-- Turkey data will be appended here -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="turkeyModal" tabindex="-1" aria-labelledby="turkeyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="turkeyModalLabel">Add Turkey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="turkeyForm">
                        <div class="form-group">
                            <label for="turkeyName">Name</label>
                            <input type="text" class="form-control" id="turkeyName" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyWeight">Weight</label>
                            <input type="number" class="form-control" id="turkeyWeight" step="0.01" max="999.99" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyAge">Age</label>
                            <input type="number" class="form-control" id="turkeyAge" max="999" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyStatus">Status</label>
                            <select class="form-control" id="turkeyStatus" required>
                            <option value="">Select the turkey status!</option>    
                            <option value="alive">Alive</option>
                                <option value="cooked">Cooked</option>
                                <option value="frozen">Frozen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="turkeyColor">Color</label>
                            <input type="color" class="form-control" id="turkeyColorPicker" required>
                            <input type="hidden" id="turkeyColor" name="turkeyColor">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add_turkey').click(function() {
                $('#turkeyModal').modal('show');
            });

            $('#turkeyColorPicker').change(function() {
                var color = $(this).val();
                var colorName = getColorName(color);
                $('#turkeyColor').val(colorName);
            });

            $('#turkeyForm').submit(function(event) {
                event.preventDefault();
                
                alert('Turkey added successfully!');
                $('#turkeyModal').modal('hide');
            });

            function getColorName(color) {
                switch(color) {
                    case '#ff0000': return 'Red';
                    case '#00ff00': return 'Green';
                    case '#0000ff': return 'Blue';
                    case '#ffff00': return 'Yellow';
                    case '#ff00ff': return 'Magenta';
                    default: return 'Unknown';
                }
            }

            // Fetch all turkeys
            $.ajax({
                url: 'api.php?action=getAllTurkeys',
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        $('#warning').removeClass('d-none');
                    } else {
                        var turkeyTableBody = $('#turkeyTableBody');
                        data.forEach(function(turkey, index) {
                            var row = '<tr>' +
                                '<th scope="row">' + (index + 1) + '</th>' +
                                '<td>' + turkey.name + '</td>' +
                                '<td>' + turkey.weight + '</td>' +
                                '<td>' + turkey.age + '</td>' +
                                '<td>' + turkey.status + '</td>' +
                                '<td><div style="width: 20px; height: 20px; background-color: ' + turkey.color + ';"></div></td>' +
                                '<td>' + turkey.created_at + '</td>' +
                                '<td style="background-color: ' + turkey.color + '; text-align: center;"><img src="assets/images/' + turkey.status + '.webp" alt="' + turkey.status + '" style="width: 50px; height: 50px;"></td>' +
                                '</tr>';
                            turkeyTableBody.append(row);
                        });
                    }
                },
                error: function() {
                    $('#warning').removeClass('d-none');
                }
            });
        });
    </script>
</body>
</html>
