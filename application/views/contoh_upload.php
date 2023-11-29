<html>
    <div>
        <?php echo $this->session->flashdata('error') ?>
    </div>

    <div>
        <?php if ( ! empty($this->session->flashdata('data'))): ?>
            <?php pre($this->session->flashdata('data')); ?>
        <?php endif ?>
    </div>

    <?php if (isset($data)): ?>
        <?php pre($data) ?>
    <?php endif ?>
    <br /><br />

    <?php echo form_open_multipart('contoh/do_upload') ?>
        <input type="file" name="dokumen_1"> <br /><br />
        <input type="file" name="dokumen_2"> <br /><br />

        <button type="submit" value="upload" name="upload">Submit !</button>
    <?php echo form_close() ?>

</html>