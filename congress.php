<html>
    <head>
		         <style type="text/css">
				      .divho
					  {
						 margin:auto;
						 width:400px;					 
					  }
					  .divhi
					  {
						  margin-left:50px;
						  width:400px;
					  }
				      .divo
					  {
						 border: 1px solid; 
						 width: 400px;
						 height:200px;
						 margin:auto;
					  }
					  .divi
					  {
						  margin-left:80px;
						  margin-top:20px;
					  }
					  .divinput
					  {
						  margin-left:50px;
					  }
					  .php1
					  {
						  width:1000px;
						  height:350px;
						  margin:auto;
						  margin-top:10px;
					  }
					  .php2
					  {
						  margin-left:200px;
					  }
					  .php3
					  {
						  width:800px;
						  height:500px;
						  margin-left:100px;
						  border: solid 1px;
					  }
					  .php4
					  {
						  width:800px;
						  height:250px;
						  margin-left:120px;
						  border: solid 1px;
					  }
					  .php5
					  {
						  margin-left:120px;
					  }
				 </style>
	</head>
	<body>
		        <script>
				      function check1()
					  {
						  var se=document.getElementById("db").value;
						  var ke=document.getElementById("blank").value;
						  if(se=="Select your option")
						  {
								if(/^\s*$/.test(ke))
									  alert("The Following fields are missing:Congress Database and Keyword");
								else
									  alert("The Following fields are missing:Congress Database");
						  }
				          else if(/^\s*$/.test(ke))
									  alert("The Following fields are missing: Keyword");
							   
						  else
						  {
							   return true;
						  }
					  }
					  
				      function change(val)
					  {
						  var k=document.getElementById("keyword");
						  var val1=val.value;
						  if(val1=="Legislators")
						  {
						         k.innerHTML="State/Representative*";
						  }
						  else if(val1=="Committees")
						  {
							     k.innerHTML="Committee ID*";
						  }
						  else if(val1=="Bills")
						  {
							     k.innerHTML="Bill ID*";
						  }
						  else 
						  {
							     k.innerHTML="Amendment ID*";
						  }
					  }
					  function spacerep()
					  {
						  document.getElementById("blank").value=document.getElementById("blank").value.trim();
					  }
					  function resetf()
					  {
						  document.getElementById("keyword").innerHTML="Keyword *";
						  document.getElementById("blank").value="";
						  document.getElementById("db").value="Select your option";
					  }
				</script>

	 	         <div class="divho"><div class="divhi"><h2>Congress Information Search</h2></div></div>
	 	         <div class="divo">
				<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">	     
						 <div class="divi">
							 <p>Congress Database
	 						 <select id="db" name="db" onChange="change(this)">
	 						     <option selected disabled>Select your option</option>
								 
								 <option value="Legislators" <?php if(isset($_POST['db']) && $_POST['db'] == "Legislators") echo 'selected="selected"'; else if(isset($_GET['db']) && $_GET['db'] == "Legislators") echo 'selected="selected"';?>>Legislators</option>
	 							 
								 <option value="Committees" <?php if(isset($_POST['db'])&& $_POST['db']=="Committees") echo 'selected="selected"';?>>Committees</option>
	 							 
								 <option value="Bills" <?php if(isset($_POST['db']) && $_POST['db'] == "Bills") echo 'selected="selected"'; else if(isset($_GET['db']) && $_GET['db'] == "Bills") echo 'selected="selected"'; ?>>Bills</option>
	 							 
								 <option <?php if(isset($_POST['db']) && $_POST['db'] == "Amendments") echo 'selected="selected"'; ?>>Amendments</option>
	 						 </select>
							 </p>
	 						 <p>Chamber <input type="radio" name="ch" value="senate" checked />Senate <input type="radio" name="ch" value="house"/>house</p>
	 						 
							 <p><span id="keyword" name="keyword">Keyword *</span>  <input type="textarea" id="blank" name="blank" value="<?php if(isset($_POST["blank"])) echo $_POST['blank']; else if(isset($_GET['blank1'])) echo $_GET['blank1']; else echo "";?>"onchange=spacerep() /></p>
							 
							 <div class="divinput">
						      <input type="submit" name="submit" value="select" onclick="check1()"/> <input type="submit" value="clear" onclick="resetf()"/>
							 </div>
							  
							  <p><a href="http://sunlightfoundation.com/">Powered By Sunlight Foundations</a></p>
					     </div>
			     </form>
	 		 </div>
			 <div class="php1">
			      <?php if (isset($_POST["submit"])): ?>
	                 <?php $stri="https://congress.api.sunlightfoundation.com/";?>
	                 <?php 
	
	                     $states= array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District Of Columbia","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
	
	                     $abbrevation=array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");
						 
	                     $temp=$_POST["blank"];
	                     $const=0;
						 
						 ini_set("allow_url_fopen", 1);
						 if(!empty($_POST["db"]))
						 {
						 if($_POST["db"]=="Legislators")
						 {
						   if(!empty($_POST["blank"]))
						   {
							   
						         $stri.="legislators?chamber=".$_POST["ch"];
	                             for($i=0;$i<51;$i++)
	                             {
	  	                                  if(strtolower($temp)==strtolower($states[$i]))
		                                 {
			                                $const++;
			                                $stri.="&state=".$abbrevation[$i]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
								            break;
		                                 }
	                             }
	                             
								 if(!$const)
	                             {
									 if(str_word_count($_POST["blank"])==1)
									 {
		                                  $stri.="&query=".$_POST["blank"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
		                                  $json = file_get_contents($stri);
							              $obj =json_decode($json); 
									      $l=$obj->page->count;
										  if(!($l>0))
										     echo "<p align=center style=font-size:20px>Entered Legislature has zero results</p>";
									      else
									      {
										     $table="<br/><table width=800px align=center border=1px cellspacing=0px cellpadding=10px><tr style=text-align: center;><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>";
										     for($i=0;$i<$obj->page->count;$i++)
										     {
											    $table.="<tr><td>".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</td><td>".$obj->results[$i]->state_name."</td><td>".$obj->results[$i]->chamber."</td><td><a href=congress.php?ch=".$obj->results[$i]->chamber."&blank=".$_POST["blank"]."&blank1=".$_POST['blank']."&bioguide=".$obj->results[$i]->bioguide_id."&db=".$_POST["db"]."&type=N>View Details</a></td></tr>";
											
										      }
								             $table.="</table><br/>";
								             echo ($table);
									
									      }
									 }
									 else
									 {
										 $ar=explode(" ",$_POST["blank"]);
										 $stri.="&query=".$ar[1]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
		                                 $json = file_get_contents($stri);
							             $obj =json_decode($json); 
									     $l=$obj->page->count;
										 if(!($l>0))
										     echo "<p align=center style=font-size:20px>Entered Legislature has zero results</p>";
									     else
									     {
										     $table="<br/><table width=800px align=center border=1px cellspacing=0px cellpadding=10px><tr style=text-align: center;><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>";
										     for($i=0;$i<$obj->page->count;$i++)
										     {
											     $table.="<tr><td>".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</td><td>".$obj->results[$i]->state_name."</td><td>".$obj->results[$i]->chamber."</td><td><a href=congress.php?ch=".$obj->results[$i]->chamber."&bioguide=".$obj->results[$i]->bioguide_id."&db=".$_POST["db"]."&type=N"."&blank=".$ar[1]."&blank1=".$ar[0]."%20".$ar[1].">View Details</a></td></tr>";
											
										    }
								            $table.="</table><br/>";
								            echo ($table);
										 }
									
									 }
									 	 
							     }
	                             else
	                             {
							         #echo htmlspecialchars($stri);
		                             $json = file_get_contents($stri);
									 #echo ($stri);
							         $obj =json_decode($json);
							         $l=$obj->page->count;
							         
									 if(!($l>0))
								         echo "<p align=center style=font-size:20px>Entered Legislature has zero results</p>";
							         else
							        {
								         $table="<br/><table width=800px align=center border=1px cellspacing=0px cellpadding=10px><tr style=text-align: center;><th>Name</th><th>State</th><th>Chamber</th><th>Details</th></tr>";
								         for($i=0;$i<$obj->page->count;$i++)
								         {
											 
									        $table.="<tr  align=center><td>".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</td><td>".$obj->results[$i]->state_name."</td><td>".$obj->results[$i]->chamber."</td><td><a href=congress.php?ch=".$obj->results[$i]->chamber."&blank=".$obj->results[$i]->state;
										    if(str_word_count($_POST["blank"])>1)
											{
											$ar=explode(" ",$_POST["blank"]);
											$table.="&blank1=".$ar[0]."%20".$ar[1]."&bioguide=".$obj->results[$i]->bioguide_id."&db=".$_POST["db"]."&type=S>View Details</a></td></tr>";
											}
											else
											{
										     $table.="&blank1=".$_POST['blank']."&bioguide=".$obj->results[$i]->bioguide_id."&db=".$_POST["db"]."&type=S>View Details</a></td></tr>";
											}
								         }
								         $table.="</table><br/>";
								         echo ($table);
							        }
	                            }
						    }
						    else
						     {
							   echo ("<h4></h4>");
						     }
						 }
						 else
							 if($_POST["db"]=="Committees")
							 {
								 if(!empty($_POST["blank"]))
								 {
									 if(!strpos($_POST["blank"]," ")>0)
									 {
									 $stri.="committees?committee_id=".$_POST["blank"]."&chamber=".$_POST["ch"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
									 $json = file_get_contents($stri);
							         $obj =json_decode($json);
							         $l=$obj->page->count;
									 
									 if(!($l>0))
								         echo "<p align=center style=font-size:20px>Entered Committee has zero results</p>";
							         else
									 {
										 $table="<br/><table width=800px align=center border=1px cellspacing=0px cellpadding=10px  border=1px><tr><th>Committee ID</th><th>Committee Name</th><th>Chamber</th></tr>";
										 for($i=0;$i<$obj->page->count;$i++)
								         {
											 
									        $table.="<tr align=center><td>".$obj->results[$i]->committee_id."</td><td>".$obj->results[$i]->name."</td><td>".$obj->results[$i]->chamber."</td></tr>";
								         }
								         $table.="</tr></table><br/>";
								         echo ($table);
									 }
									 }
									 else
									 {
										 echo '<script type="text/javascript">alert("Please Remove Spaces from the Committees ID entered")</script>';
									 }
								 }
								 else
								 {
									 echo ("<h4></h4>");
								 }
							 }
						 else
							 if($_POST["db"]=="Bills")
							 {
								 if(!empty($_POST["blank"]))
								 {
									 if(!strpos($_POST["blank"]," ")>0)
									 {
									 $stri.="bills?bill_id=".$_POST["blank"]."&chamber=".$_POST["ch"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
									 $json = file_get_contents($stri);
							         $obj =json_decode($json);
							         $l=$obj->page->count;
									 
									 if(!($l>0))
								         echo "<p align=center style=font-size:20px>Entered Bill_ID has zero results</p>";
							         else
									 {
										 $table="<br/><table width=800px align=center border=1px cellspacing=0px cellpadding=10px  border=1px><tr><th>Bill ID</th><th>Short Title</th><th>Chamber</th><th>Details</th></tr>";
										 for($i=0;$i<$obj->page->count;$i++)
								         {
											 
									        $table.="<tr align=center><td>".$obj->results[$i]->bill_id."</td><td>".$obj->results[$i]->short_title."</td><td>".$obj->results[$i]->chamber."</td><td><a href=congress.php?ch=".$obj->results[$i]->chamber."&blank1=".$_POST['blank']."&blank=".$_POST["blank"]."&billid=".$obj->results[$i]->bill_id."&db=".$_POST["db"].">View Details</a></td></tr>";
								         }
								         $table.="</tr></table><br/>";
								         echo ($table);
									 }
									 }
									 else
									 {
										echo '<script type="text/javascript">alert("Please Remove Spaces from the bill ID entered")</script>';
									 }
								 }
								 else
								 {
									 echo ("<h4></h4>");
								 }
							 }
						 else
							 if($_POST["db"]=="Amendments")
							 {
								   if(!empty($_POST["blank"]))
								 {
									 if(!strpos($_POST["blank"]," ")>0)
									 {
									 $stri.="amendments?amendment_id=".$_POST["blank"]."&chamber=".$_POST["ch"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
									 $json = file_get_contents($stri);
							         $obj =json_decode($json);
							         $l=$obj->page->count;
									 
									 if(!($l>0))
								         echo "<p align=center style=font-size:20px>Entered Ammendment has zero results</p>";
							         else
									 {
										 $table="<br/><table align=center width=800px  border=1px cellspacing=0px cellpadding=10px  border=1px><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr>";
										 for($i=0;$i<$obj->page->count;$i++)
								         {
											 
									        $table.="<tr align=center><td>".$obj->results[$i]->amendment_id."</td><td>".$obj->results[$i]->amendment_type."</td><td>".$obj->results[$i]->chamber."</td><td>".$obj->results[$i]->introduced_on."</td></tr>";
								         }
								         $table.="</tr></table><br/>";
								         echo ($table);
									 }
								    }
									else
									{
										echo '<script type="text/javascript">alert("Please Remove Spaces from the Ammendment ID entered")</script>';
									}
								 }
								 else
								 {
									 echo ("<h4></h4>");
								 }
								 
							 }
						 }
						 else
						 {
							 echo ("<h4><h4>");
						 }
	                    ?>
                 <?php endif; ?>
				 <?php if(!empty($_GET["ch"])):?>
				   <?php 
				         ini_set("allow_url_fopen", 1);
				         if($_GET["db"]=="Legislators")
						 {
							if($_GET["type"]=="S")
							 {
								 $url="https://congress.api.sunlightfoundation.com/legislators?chamber=".$_GET["ch"]."&state=".$_GET["blank"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
							 }
							 else
							 {
								 $url="https://congress.api.sunlightfoundation.com/legislators?chamber=".$_GET["ch"]."&query=".$_GET["blank"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
							 }
								 $json = file_get_contents($url);
							     $obj =json_decode($json);
							     $l=$obj->page->count;
								 $t="";
								 for($i=0;$i<$l;$i++)
								 {
									 if($_GET["bioguide"]==$obj->results[$i]->bioguide_id)
									 {
										 $t.="<div class=php3><table width=800px align=center border=0px cellspacing=0px cellpadding=10px>
										 <tr align=center>
										 <th colspan=2><img src=https://theunitedstates.io/images/congress/225x275/".$obj->results[$i]->bioguide_id.".jpg width=200px height=250px/><br/></th></tr>
										 </table><br/>
										 <div class=php2>
										 <table align=center width=490px>
										 <tr><td>Full Name</td><td></td><td>".$obj->results[$i]->title." ".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</td></tr>
										 <tr><td>Term ends on</td><td> </td><td>".$obj->results[$i]->term_end."</td>
										 </tr>
										 <tr><td>Website</td><td></td><td><a href=".$obj->results[$i]->website." target=_blank>".$obj->results[$i]->website."</a></td>
										 </tr> 
										 <tr><td>Office</td><td></td><td>".$obj->results[$i]->office."</td>
										 </tr>"; 
										 if($obj->results[$i]->facebook_id)
										 {
									     $t.="<tr><td>Facebook</td><td></td><td><a href=https://www.facebook.com/".$obj->results[$i]->facebook_id." target=_blank>".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</a></td>
										 </tr>";
										 } 		
                                          else
										  {
											  $t.="<tr><td>Facebook</td><td></td><td>NA</td></tr>";
										  }											  
										 $t.="<tr><td>Twitter</td><td></td><td><a href=https://twitter.com/".$obj->results[$i]->twitter_id." target=_blank>".$obj->results[$i]->first_name." ".$obj->results[$i]->last_name."</a></td></tr>
										 </table>
										 </div>
										 </div><br/>";
										 break;
									 }
								 }
								 echo ($t);
							}
							else if($_GET["db"]=="Bills")
							{
								$url="https://congress.api.sunlightfoundation.com/bills?&bill_id=".$_GET["blank"]."&chamber=".$_GET["ch"]."&apikey=82be6b89ccb84ec68b3a90e00bc5ed52";
								$json = file_get_contents($url);
							     $obj =json_decode($json);
							     $l=$obj->page->count;
								 $t="";
								 for($i=0;$i<$l;$i++)
                                 {
									 if($_GET["billid"]==$obj->results[$i]->bill_id)
									 {
										 $t.="<br/><div class=php4><br/><br/><div class=php5><table width=600px align=center border=0px cellspacing=0px>
										 <tr>
										  <td>Bill ID</td>
										  <td>".$obj->results[$i]->bill_id."</td>
										 </tr>";
										 if($obj->results[$i]->short_title)
										 {
											 $t.="<tr>
										  <td>Bill Title</td>
										  <td>".$obj->results[$i]->short_title."</td>
										 </tr>";
										 }
										 else
										 {
											 $t.="<tr>
										        <td>Bill Title</td>
										        <td>NA</td>
										        </tr>";
										 }
										 $t.="<tr>
										 <td>Sponsor</td>
										 <td>".$obj->results[$i]->sponsor->title." ".$obj->results[$i]->sponsor->first_name." ".$obj->results[$i]->sponsor->last_name."</td>
										 </tr>
										 <tr>
										   <td>Introduced On</td>
										   <td>".$obj->results[$i]->introduced_on."</td>
										 </tr>
										 <tr>
										   <td>Last action with Date</td>
										   <td>".$obj->results[$i]->last_version->version_name.",".$obj->results[$i]->last_action_at."</td>
										 </tr>";
										 if($obj->results[$i]->short_title)
										 {
										 $t.="<tr>
										   <td>Bill URL</td>
										   <td><a href=".$obj->results[$i]->last_version->urls->pdf." target=_blank>".$obj->results[$i]->short_title."</a></td></tr>";
										 }
										 else
										 {
											 $t.="<tr>
										   <td>Bill URL</td>
										   <td><a href=".$obj->results[$i]->last_version->urls->pdf." target=_blank>".$obj->results[$i]->bill_id."</a></td></tr>";
										 }
										 $t.="</table></div></div><br/>";
								     }
								 }
								 echo ($t);
							}
				   ?>
				 <?php endif;?>
			 </div>
			 <noscript/>
</body>
</html>