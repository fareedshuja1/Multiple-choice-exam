<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT DATE_FORMAT(em.`exam_date`,'%d-%m-%Y') AS exam_date,
TIME_FORMAT(em.`e_start_time`, '%H') AS starting_h
,TIME_FORMAT(em.`e_start_time`, '%i') AS starting_min
,TIME_FORMAT(em.`e_end_time`, '%H') AS ending_h
,TIME_FORMAT(em.`e_end_time`, '%i') AS ending_min
,em.`tot_minutes`,em.`pass_per` 
FROM `exam_master` AS em
WHERE em.`em_id`= '$id'") or die(mysql_error());
$row = mysql_fetch_assoc($query);
}

$year=date("Y");
$year1=$year;
$yearFirst = $year-5;
$yearEnd=$year+50;

?>
                       <form action="" method="post" enctype="multipart/form-data">
                       <table width="100%" cellpadding="10" cellspacing="" border="0">
                       <tr>
                       <td>        
                        
                    <table cellpadding="10" border="0">
                    <tr>
                    <td>              
                    <label for="exampleInputEmail1">Start Time</label><br />
                    <select name="shour" style="width: 50px; height:40px">
                    <option value="<?php echo $row['starting_h']; ?>"><?php echo $row['starting_h']; ?></option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="00">00</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="sminute" style="width: 50px; height:40px">
                    <option value="<?php echo $row['starting_min']; ?>"><?php echo $row['starting_min']; ?></option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                    </select>
                    </td>
                    <td>                       
                    <label for="exampleInputEmail1">End Time</label><br />
                    <select name="ehour" style="width: 50px; height:40px">
                    <option value="<?php echo $row['ending_h']; ?>"><?php echo $row['ending_h']; ?></option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="00">00</option>
                    </select>
                    &nbsp;&nbsp;&nbsp;
                    <select name="eminute" style="width: 50px; height:40px">
                    <option value="<?php echo $row['ending_min']; ?>"><?php echo $row['ending_min']; ?></option>
                    <option value="00">00</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    </select>
                    </td>
                    
                    <td>
                    <label for="exampleInputEmail1">Exam Date</label>
  <input type="text" class="form-control" name="exam_date"  style="width:160px" required="required" value="<?php echo $row['exam_date']; ?>">
                       <input type="hidden" name="id" value="<?php echo $id; ?>" />             
                    </td>
                    
                    
                    </tr></table></td>
                    
                       </tr>
                       
                       <tr>
                       
                       <td>
                      
                       <div style="float:left; margin-left:12px">
                       <label for="exampleInputEmail1">Total Minutes</label>
                       <input type="text" class="form-control" name="tot_minutes" style="width:160px" 
                       onkeypress='return isNumberKey(event)' required="required" value="<?php echo $row['tot_minutes']; ?>">
                       </div>
                       
                       <div style="float:left; margin-left:12px">
                       <label for="exampleInputEmail1">Passing %</label>
                       <input type="text" class="form-control" name="pass_per" style="width:160px" 
                       onkeypress='return isNumberKey(event)' required="required" value="<?php echo $row['pass_per']; ?>">
                       </div>

                       </td>
                       
                       
                       </tr>
                       </table>   
                       
                        
                         <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">CLOSE</button>
                            <button class="btn btn-warning" type="submit" name="edit-emaster">UPDATE</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                       </form>

                          </div>  