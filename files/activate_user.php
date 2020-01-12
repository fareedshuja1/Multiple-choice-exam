<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT * FROM `login` WHERE `username` = '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}
?>
                       <form action="" method="post">
                       <br />
                       <span style="margin-left:30px; font-size:16px">Are you sure to activate the user account?</span>
                       <br />
                       <input type="hidden" name="id" value="<?php echo $row['username']; ?>" />
                       <div class="modal-footer">
                       <button data-dismiss="modal" class="btn btn-default" type="button">NO</button>
                       <button class="btn btn-warning" type="submit" name="active-state">YES</button>
                       </div>
                       </div>
                       </div>
                       </div>
                       </form>

                          </div>  