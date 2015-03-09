<form id="addNewsCategoryForm" action="#" class="form-horizontal">
    <fieldset>
        <legend></legend>
        <div class="row-fluid">
            <div class="span6 ">
                <div class="control-group">
                    <label class="control-label">Нэр</label>
                    <div class="controls">
                        <input type="text" name="name" class="m-wrap span12 newsCategoryName" value="{{$category['name']}}" placeholder="">
                        <span class="help-block">Мэдээний ангилалын нэр</span>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>