<div class="page-header">
    <div class="row">
        <div id="registration" class="col-md-6">
            <form name = "reg" id="regform" class="text-right">
                <div class="form-group field">
                    <label for="name">Name </label>
                    <input id="name" type="text" name="name" size="40" required/><br><span id="namemsg"></span><br>
                    <label for="email">Email </label>
                    <input id="email" type="text" name="email" size="40" required/><br><span id="emailmsg"></span><br>
                    <div id="region">                        
                        <select name="1" id="1" class="chosen">
                            <option value='0' selected>-----</option>
                            <?php
                            foreach ($region as $reg) {
                                echo "<option value=" . $reg['ter_id'] . ">" . $reg['ter_name'] . "</option>";
                            }
                            ?>
                        </select>                        
                    </div>
                    <span id="listmsg"></span><br>
                    <input type="button" id="submit" value="Send" class="btn btn-primary"/>
                </div>                
            </form>
        </div>
    </div>
</div>