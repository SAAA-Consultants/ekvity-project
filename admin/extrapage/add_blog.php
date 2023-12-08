<?php
session_start();
include('config/authentication.php'); 
include('config/connection.php');
include('includes/header.php');
?>



<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Ekvity Blog</h1>
                    </div>
                    <form class="user" id="blogForm" action="process.php" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    name="blogName" placeholder="Blog Name" >
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user"
                                    name="authorName" placeholder="Author Name" >
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    name="smallDescription" placeholder="Small Description" >
                            </div>
                            <div class="col-sm-6">
                                <input type="file" class="form-control form-control-user"
                                    name="blogImage" placeholder="Blog Image" >
                            </div>
                        </div>

                        <div id="blogInputs">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        name="subtitle[]" placeholder="Sub Title" required>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="text" name="description[]" placeholder="Description" required></input>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success mt-4" onclick="addInput()">+</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Submit Now
                        </button>
                        <hr>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addInput() {
        var div = document.createElement('div');
        div.innerHTML = '<div class="form-group row">' +
                            '<div class="col-sm-6 mb-3 mb-sm-0">' +
                                '<input type="text" class="form-control form-control-user" name="subTitle[]" placeholder="Sub Title" required>' +
                            '</div>' +
                            '<div class="col-sm-6">' +
                                ' <input class="form-control form-control-user" type="text" name="description[]" placeholder="Description" required></input>' +
                            '</div>' +
                            '<div class="col-sm-1">' +
                                '<button type="button" class="btn btn-danger mt-4" onclick="removeInput(this)">-</button>' +
                            '</div>' +
                        '</div>';
        document.getElementById('blogInputs').appendChild(div);
    }

    function removeInput(element) {
        var parentDiv = element.parentNode.parentNode;
        parentDiv.parentNode.removeChild(parentDiv);
    }
</script>


</div>
</div>


<?php include('includes/footer.php');?>