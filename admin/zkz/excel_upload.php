<?php
    $type=$_GET['type'];
?>
<strong>导入对应excel文件</strong>
    <p>根据需求导入对应excel文件，文件格式需满足样表格式。</p>
     <form method="POST" name="form" action="<?=$type;?>_excel_upload.php" enctype="multipart/form-data">
     	<input type="file" name="excel" id="excel">&nbsp;&nbsp;<input type='submit' value='上传文件'>
     </form>
