<div class="container-fluid">
    <div class="row">

        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูล</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form method="post">

                        <?php foreach ($data as $item) : ?>
                            <div class="col-md-6 mb-3">
                                    <input type="hidden" class="form-control" id="_id" name="_id" placeholder="First name" value="<?= $item['admin_id']; ?>" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="show_email">Email</label>
                                    <input type="text" class="form-control" id="_email" name="_email" placeholder="Last name" value="<?= $item['admin_email']; ?>"required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01">ชื่อจริง</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?= $item['firstname']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02">นามสกุล</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value="<?= $item['lastname']; ?>" required>
                                </div>

                            </div>


                            <button class="btn btn-primary" type="submit">แก้ไขข้อมูล</button>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>



    </div>

</div>