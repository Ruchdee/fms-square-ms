<input type="hidden" id="activity-id" name="activity-id" value="<?php echo $_POST['activity-id']; ?>">
<div class="compose-box">
    <div class="compose-content" id="addTaskModalTitle">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-1">
                    <div class="w-100">
                        <input id="student-email" name="student-email" type="email" placeholder="ระบุอีเมล*" class="form-control" required maxlength="100">
                        <span class="invalid-tooltip">ระบุอีเมล</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mail-to mb-2">
                    <div class="w-100">
                        <input id="student-phone" name="student-phone" type="tel" placeholder="ระบุเบอร์โทรศัพท์*" class="form-control" required maxlength="50">
                        <span class="invalid-tooltip">ระบุเบอร์โทรศัพท์</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>