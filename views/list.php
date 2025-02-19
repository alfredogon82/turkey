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
            <button class="btn btn-primary">Report</button>
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
                    <form id="createTurkeyForm">
                        <div class="form-group">
                            <label for="turkeyName">Name</label>
                            <input type="text" class="form-control" id="turkeyName" name="name" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyWeight">Weight</label>
                            <input type="number" class="form-control" id="turkeyWeight" name="weight" step="0.01" max="999.99" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyAge">Age</label>
                            <input type="number" class="form-control" id="turkeyAge" name="age" max="999" required>
                        </div>
                        <div class="form-group">
                            <label for="turkeyStatus">Status</label>
                            <select class="form-control" id="turkeyStatus" name="status" required>
                            <option value="">Select the turkey status!</option>    
                            <option value="alive">Alive</option>
                                <option value="cooked">Cooked</option>
                                <option value="frozen">Frozen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="turkeyColor">Color</label>
                            <input type="color" class="form-control" id="turkeyColorPicker" required>
                            <input type="hidden" id="turkeyColor" name="color">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editTurkeyModal" tabindex="-1" aria-labelledby="editTurkeyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTurkeyModalLabel">Edit Turkey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTurkeyForm">
                        <input type="hidden" id="editTurkeyId" name="id">
                        <div class="form-group">
                            <label for="editTurkeyName">Name</label>
                            <input type="text" class="form-control" id="editTurkeyName" name="name" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="editTurkeyWeight">Weight</label>
                            <input type="number" class="form-control" id="editTurkeyWeight" name="weight" step="0.01" max="999.99" required>
                        </div>
                        <div class="form-group">
                            <label for="editTurkeyAge">Age</label>
                            <input type="number" class="form-control" id="editTurkeyAge" name="age" max="999" required>
                        </div>
                        <div class="form-group">
                            <label for="editTurkeyStatus">Status</label>
                            <select class="form-control" id="editTurkeyStatus" name="status" required>
                                <option value="">Select the turkey status!</option>
                                <option value="alive">Alive</option>
                                <option value="cooked">Cooked</option>
                                <option value="frozen">Frozen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTurkeyColor">Color</label>
                            <input type="color" class="form-control" id="editTurkeyColorPicker" required>
                            <input type="hidden" id="editTurkeyColor" name="color">
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
                $('#turkeyColor').val(color);
            });

            $('#createTurkeyForm').submit(function(event) {
                event.preventDefault();

                var color = $('#turkeyColorPicker').val();
                $('#turkeyColor').val(color);

                const formData = new FormData(this);
                const data = {
                    name: formData.get('name'),
                    weight: formData.get('weight'),
                    age: formData.get('age'),
                    status: formData.get('status'),
                    color: formData.get('color')
                };
                fetch('api.php?action=createTurkey', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Turkey created successfully');
                        location.reload();
                    } else {
                        alert('Error creating turkey');
                    }
                });
                $('#turkeyModal').modal('hide');
            });

            $('#editTurkeyColorPicker').change(function() {
                var color = $(this).val();
                $('#editTurkeyColor').val(color);
            });

            $('#editTurkeyForm').submit(function(event) {
                event.preventDefault();

                var color = $('#editTurkeyColorPicker').val();
                $('#editTurkeyColor').val(color);

                const formData = new FormData(this);
                const data = {
                    id: formData.get('id'),
                    name: formData.get('name'),
                    weight: formData.get('weight'),
                    age: formData.get('age'),
                    status: formData.get('status'),
                    color: formData.get('color')
                };
                fetch('api.php?action=editTurkey', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Turkey updated successfully');
                        location.reload();
                    } else {
                        alert('Error updating turkey');
                    }
                });
                $('#editTurkeyModal').modal('hide');
            });

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
                            var row = '<tr data-id="' + turkey.id + '">' +
                                '<th scope="row">' + (index + 1) + '</th>' +
                                '<td>' + turkey.name + '</td>' +
                                '<td>' + turkey.weight + '</td>' +
                                '<td>' + turkey.age + '</td>' +
                                '<td>' + turkey.status + '</td>' +
                                '<td><div style="width: 20px; height: 20px; background-color: ' + turkey.color + ';"></div></td>' +
                                '<td>' + turkey.created_at + '</td>' +
                                '</tr>';
                            turkeyTableBody.append(row);
                        });

                        $('#turkeyTableBody tr').click(function() {
                            var id = $(this).data('id');
                            var turkey = data.find(t => t.id == id);
                            $('#editTurkeyId').val(turkey.id);
                            $('#editTurkeyName').val(turkey.name);
                            $('#editTurkeyWeight').val(turkey.weight);
                            $('#editTurkeyAge').val(turkey.age);
                            $('#editTurkeyStatus').val(turkey.status);
                            $('#editTurkeyColorPicker').val(turkey.color);
                            $('#editTurkeyColor').val(turkey.color);
                            $('#editTurkeyModal').modal('show');
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
