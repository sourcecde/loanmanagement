<?php
//Variables for connecting to your database.
//These variable values come from your hosting account.
$hostname = "localhost:3306";
$db_username = "agorg_ag8";
$dbname = "agorg_ag8";
$db_password = "Ag8_123";

$hostname = "182.50.133.171";
$db_username = "loanmanagement";
$dbname = "loanmanagement";
$db_password = "Loan@123"; 

mysql_connect($hostname, $db_username, $db_password) OR DIE ("Unable to
connect to database! Please try again later.");
mysql_select_db($dbname);

/*


CREATE TABLE `tbl_submissions` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Table structure for table `tbl_testanswers`
--

CREATE TABLE `tbl_testanswers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testgroups`
--

CREATE TABLE `tbl_testgroups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `group_text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testquestions`
--

CREATE TABLE `tbl_testquestions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `question_text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tests`
--

CREATE TABLE `tbl_tests` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_text` varchar(200) DEFAULT NULL,
  `test_pass` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

CREATE TABLE `tbl_ratingquestions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE `tbl_ratinganswers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `question_text` varchar(200) DEFAULT NULL,
  `answer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

INSERT INTO `tbl_users` VALUES(1, 'admin', 'admin1234', 'admin', 'Admin', '8017715423', 'Enabled');

echo getBookingCSV();
echo adminLogin("admin","admin1234") . "<br>";
echo adminLogin("admin","admin12345") . "<br>";
print_r(getUserDetails(adminLogin("admin","admin1234")));
echo "<br>" . userLogin("rooit1","1234") . "<br>";
print_r(getUserDetails(userLogin("rooit3","1234a")));
echo "<br>" . addUser("rooit2","1234","Rohit Agarwal","9573697801");
echo "<br>" . editUserDetails(5,"rooit3","1234a","Rohit Agarwala","9573697801a") . "<br>";

*/

function adminLogin($username,$password){
    $query = sprintf("SELECT * FROM tbl_users WHERE type='admin' AND username='%s' AND password='%s'", safe($username), safe($password));
  $result = mysql_query($query);
  $num = mysql_num_rows ($result);
  if ($num==1) {
    $row = mysql_fetch_array($result);
    $user_id=$row['user_id'];
    return $user_id;
  } 
  else {
    return 0;
  }
}

function borrowerLogin($username,$password){
    $query = sprintf("SELECT * FROM tbl_users WHERE type='borrower' AND username='%s' AND password='%s'", safe($username), safe($password));
  $result = mysql_query($query);
  $num = mysql_num_rows ($result);
  if ($num==1) {
    $row = mysql_fetch_array($result);
    $user_id=$row['user_id'];
    return $user_id;
  } 
  else {
    return 0;
  }
}

function lenderLogin($username,$password){
    $query = sprintf("SELECT * FROM tbl_users WHERE type='lender' AND username='%s' AND password='%s'", safe($username), safe($password));
  $result = mysql_query($query);
  $num = mysql_num_rows ($result);
  if ($num==1) {
    $row = mysql_fetch_array($result);
    $user_id=$row['user_id'];
    return $user_id;
  } 
  else {
    return 0;
  }
}

function addUser($username,$password,$name,$phone,$email,$address,$type){
  $query = sprintf("INSERT INTO tbl_users  (username, password, type, name, phone,email,address,state) VALUES ('%s','%s','%s','%s','%s','%s','%s','Enabled')", $username,$password,$type, $name,$phone,$email,$address);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function addLoan($borrower_id,$lender_id,$amount,$start_date,$interest_rate,$term,$term_freq,$schedule,$notes){
  $query = sprintf("INSERT INTO tbl_loans  (borrower_id, lender_id, amount, start_date, interest_rate,term,term_freq,schedule,notes) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s')", $borrower_id,$lender_id,$amount,$start_date,$interest_rate,$term,$term_freq,$schedule,$notes);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function addLoanEntry($entry_date,$amount,$description,$loan_id,$entry_type,$notes){
  $query = sprintf("INSERT INTO tbl_entries  (entry_date, amount, description, loan_id, entry_type,notes) VALUES ('%s','%s','%s','%s','%s','%s')", $entry_date,$amount,$description,$loan_id,$entry_type,$notes);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getUsers($type)
{
  $query = sprintf("SELECT * FROM tbl_users  WHERE type='%s'",$type);
  $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getUserCount($type)
{
  $query = sprintf("SELECT count(1) num FROM tbl_users  WHERE type='%s'",$type);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  $num=$row['num'];
  return $num;
}

function getLoanCount()
{
  $query = sprintf("SELECT count(1) num FROM tbl_loans");
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  $num=$row['num'];
  return $num;
}

function getUserDetails($user_id){
  $query = sprintf("SELECT * FROM tbl_users WHERE user_id='%s'", $user_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function editUserDetails($user_id,$username,$password,$name,$phone,$email,$address){
  $query = sprintf("UPDATE tbl_users SET username='%s', password='%s', name='%s', phone='%s',email='%s',address='%s' WHERE  user_id='%s'", $username,$password,$name,$phone,$email,$address,$user_id);
  //echo $query;
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getLoans()
{
    $result = mysql_query("SELECT loan_id,l.borrower_id 'borrower_id',b.name 'borrower_name',l.lender_id 'lender_id', c.name 'lender_name',amount,start_date FROM `tbl_loans` l left join `tbl_users` b on l.borrower_id=b.user_id left join `tbl_users` c on l.lender_id=c.user_id");
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}


function getLoanDetails($loan_id){
  $query = sprintf("SELECT loan_id,l.borrower_id 'borrower_id',b.name 'borrower_name',b.address 'borrower_address',b.phone 'borrower_phone',b.email 'borrower_email',l.lender_id 'lender_id', c.name 'lender_name',c.address 'lender_address',c.phone 'lender_phone',c.email 'lender_email',amount,start_date,interest_rate,term,term_freq,schedule,notes FROM `tbl_loans` l left join `tbl_users` b on l.borrower_id=b.user_id left join `tbl_users` c on l.lender_id=c.user_id WHERE loan_id='%s'", $loan_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function editLoanDetails($loan_id,$borrower_id,$lender_id,$amount,$start_date,$interest_rate,$term,$term_freq,$schedule,$notes){
  $query = sprintf("UPDATE tbl_loans SET borrower_id='%s', lender_id='%s', amount='%s', start_date='%s',interest_rate='%s',term='%s',term_freq='%s',schedule='%s',notes='%s' WHERE  loan_id='%s'", $borrower_id,$lender_id,$amount,$start_date,$interest_rate,$term,$term_freq,$schedule,$notes,$loan_id);
  //echo $query;
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function getLoanEntries($loan_id)
{
    $result = mysql_query(sprintf("SELECT * from `tbl_entries`  WHERE loan_id='%s' order by entry_date ", $loan_id));
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;

}
/*

function userLogin($username,$password){
  $query = sprintf("SELECT * FROM tbl_users WHERE type='user' AND username='%s' AND password='%s'", safe($username), safe($password));
  $result = mysql_query($query);
  $num = mysql_num_rows ($result);
  if ($num==1) {
    $row = mysql_fetch_array($result);
    $user_id=$row['user_id'];
    return $user_id;
  } 
  else {
    return 0;
  }
}

function getUserDetails($user_id){
  $query = sprintf("SELECT * FROM tbl_users WHERE user_id='%s'", $user_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}


function editUserDetails($user_id,$username,$password,$name,$phone){
  $query = sprintf("UPDATE tbl_users SET username='%s', password='%s', name='%s', phone='%s' WHERE type='user' and user_id='%s'", $username,$password,$name,$phone,$user_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function disableUser($user_id){
    $query = sprintf("UPDATE tbl_users SET state='Disabled' WHERE type='user' and user_id='%s'", $user_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function enableUser($user_id){
    $query = sprintf("UPDATE tbl_users SET state='Enabled' WHERE type='user' and user_id='%s'", $user_id);
    if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteUser($user_id){
  $query = sprintf("DELETE FROM tbl_users WHERE  user_id= '%s'", $user_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getUsers()
{
    $result = mysql_query("SELECT * FROM tbl_users  WHERE type='user'");
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}


function addEditEvents($user_id,$event_name,$status)
{
  if(checkEvents($user_id,$event_name)=='NOT_SET')
    return addEvent($user_id,$event_name,$status);
  else 
    return editEvents($user_id,$event_name,$status);
}


function checkEvents($user_id,$event_name){
  $query = sprintf("SELECT * FROM tbl_events WHERE user_id='%d' AND event_name='%s'", $user_id,$event_name);
  $result = mysql_query($query);
  $num = mysql_num_rows ($result);
  if ($num==1) {
    $row = mysql_fetch_array($result);
    $status=$row['status'];
    return $status;
  } 
  else {
    return "NOT_SET";
  }
}
function addEvent($user_id,$event_name,$status){
  $query = sprintf("INSERT INTO tbl_events  (user_id, event_name, status) VALUES ('%d','%s','%s')", $user_id,$event_name,$status);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function editEvents($user_id,$event_name,$status){
  $query=null;
  if(checkEvents($user_id,$event_name)=='completed' && $status!='completed')
    $query = sprintf("UPDATE tbl_events SET status='%s',attempts=attempts+1 WHERE user_id='%d' and event_name='%s'", $status,$user_id,$event_name);
  else
    $query = sprintf("UPDATE tbl_events SET status='%s' WHERE user_id='%d' and event_name='%s'", $status,$user_id,$event_name);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function editRating($user_id,$event_name,$rating)
{
   $query = sprintf("UPDATE tbl_events SET rating='%d' WHERE user_id='%d' and event_name='%s'", $rating,$user_id,$event_name);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getUserEvents($user_id)
{
    $query=sprintf("SELECT * FROM tbl_events  WHERE user_id='%d'",$user_id);
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function addQuestion($question_text){
  $query = sprintf("INSERT INTO tbl_ratingquestions   (question_text) VALUES ('%s')", $question_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteQuestion($question_id){
  $query = sprintf("DELETE FROM tbl_ratingquestions WHERE  question_id= %d", $question_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editQuestion($question_id,$question_text){
   $query = sprintf("UPDATE tbl_ratingquestions SET question_text='%s' WHERE question_id=%d", $question_text,$question_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getQuestions()
{
    $query=sprintf("SELECT * FROM tbl_ratingquestions");
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getQuestion($question_id){
  $query = sprintf("SELECT * FROM tbl_ratingquestions WHERE question_id='%s'", $question_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function getAnswers($user_id,$event_name)
{
  $query=sprintf("SELECT * FROM tbl_ratinganswers where user_id=%d and event_name='%s'",$user_id,$event_name);
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}


function addEmotion($emotion_text){
  $query = sprintf("INSERT INTO tbl_ratingemotions   (emotion_text) VALUES ('%s')", $emotion_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteEmotion($emotion_id){
  $query = sprintf("DELETE FROM tbl_ratingemotions WHERE  emotion_id= %d", $emotion_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editEmotion($emotion_id,$emotion_text){
   $query = sprintf("UPDATE tbl_ratingemotions SET emotion_text='%s' WHERE emotion_id=%d", $emotion_text,$emotion_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getEmotions()
{
    $query=sprintf("SELECT * FROM tbl_ratingemotions order by emotion_id");
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getEmotion($emotion_id){
  $query = sprintf("SELECT * FROM tbl_ratingemotions WHERE emotion_id='%s'", $emotion_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function addNumber($number_page,$number_text){
  $query = sprintf("INSERT INTO tbl_scrollnumbers   (number_page,number_text) VALUES ('%s','%s')", $number_page,$number_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteNumber($number_id){
  $query = sprintf("DELETE FROM tbl_scrollnumbers WHERE  number_id= %d", $number_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editNumber($number_id,$number_page,$number_text){
   $query = sprintf("UPDATE tbl_scrollnumbers SET number_page='%s',number_text='%s' WHERE number_id=%d", $number_page,$number_text,$number_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getNumbers()
{
    $query=sprintf("SELECT * FROM tbl_scrollnumbers");
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getNumber($number_id){
  $query = sprintf("SELECT * FROM tbl_scrollnumbers WHERE number_id='%s'", $number_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function addGroup($group_text){
  $query = sprintf("INSERT INTO tbl_groups   (group_text) VALUES ('%s')", $group_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteGroup($group_id){
  $query = sprintf("DELETE FROM tbl_groups WHERE  group_id= %d", $group_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editGroup($group_id,$group_text){
   $query = sprintf("UPDATE tbl_groups SET group_text='%s' WHERE group_id=%d", $group_text,$group_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function addGroupLabel($group_id,$grouplabel_text){
  $query = sprintf("INSERT INTO tbl_grouplabels   (group_id,grouplabel_text) VALUES (%d,'%s')",$group_id, $grouplabel_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteGroupLabel($grouplabel_id){
  $query = sprintf("DELETE FROM tbl_grouplabels WHERE  grouplabel_id= %d", $grouplabel_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editGroupLabel($grouplabel_id,$grouplabel_text){
   $query = sprintf("UPDATE tbl_grouplabels SET grouplabel_text='%s' WHERE grouplabel_id=%d", $grouplabel_text,$grouplabel_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getGroupLabels($group_id)
{
    $query=sprintf("SELECT * FROM tbl_grouplabels  WHERE group_id=%d order by grouplabel_id",$group_id);
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getGroupLabel($grouplabel_id){
  $query = sprintf("SELECT * FROM tbl_grouplabels WHERE grouplabel_id='%s'", $grouplabel_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function getGroups()
{
    $query=sprintf("SELECT * FROM tbl_groups order by group_id");
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getGroup($group_id){
  $query = sprintf("SELECT * FROM tbl_groups WHERE group_id='%s'", $group_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

function clearUserData($user_id)
{
     $query = sprintf("DELETE FROM `tbl_ratinganswers` WHERE user_id=%d", $user_id);
     if (!mysql_query($query)) {
        return mysql_error(); 
        }
      $query = sprintf("DELETE FROM `tbl_events` WHERE user_id=%d", $user_id);
     if (!mysql_query($query)) {
        return mysql_error(); 
        }   
        $query = sprintf("DELETE FROM `tbl_notes` WHERE user_id=%d", $user_id);
     if (!mysql_query($query)) {
        return mysql_error(); 
        }   
    
    return "SUCCESS";
}


function addSupport($user_id,$event_name,$support_text){
  $query = sprintf("INSERT INTO `tbl_support` (user_id,event_name,support_text) VALUES (%d,'%s','%s')", $user_id,$event_name,$support_text);
        if (!mysql_query($query)) {
          return mysql_error(); 
        }        
    
    return "SUCCESS";
}

function addSupportMessage($support_id,$user_id,$supportmessage_text){
  $query = sprintf("INSERT INTO `tbl_supportmessages` (support_id,user_id,supportmessage_text,supportmessage_time) VALUES (%d,%d,'%s',NOW())", $support_id,$user_id,$supportmessage_text);
        if (!mysql_query($query)) {
          return mysql_error(); 
        }        
    
    return "SUCCESS";
}

function getSupport()
{
  $query = sprintf("select support_text,support_id,event_name,user_id,support_status from (SELECT support_text,s.support_id,event_name,s.user_id,s.support_status FROM tbl_support s, tbl_supportmessages sm where s.support_id=sm.support_id  and sm.user_id!=1 order by supportmessage_time desc) d group by support_id,support_text,event_name,user_id,support_status");
  $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getSupportMessages($support_id)
{
  $query = sprintf("select * from tbl_supportmessages where support_id=%d order by supportmessage_time desc", $support_id);
  $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function deleteSupport($support_id){
  $query = sprintf("DELETE FROM tbl_support WHERE  support_id= %d", $support_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function updateSupport($support_id){
   $query = sprintf("UPDATE tbl_support SET support_status='Answered' WHERE support_id='%d'", $support_id);
    if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function clearChat()
{
     $query=sprintf("delete from tbl_messages");
     if (!mysql_query($query)) {
        return mysql_error(); 
        }      
    return "SUCCESS";
}

function addTest($test_text,$test_pass){
  $query = sprintf("INSERT INTO tbl_tests   (test_text,test_pass) VALUES ('%s',%d)", $test_text,$test_pass);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteTest($test_id){
  $query = sprintf("DELETE FROM tbl_tests WHERE  test_id= %d", $test_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editTest($test_id,$test_text,$test_pass){
   $query = sprintf("UPDATE tbl_tests SET test_text='%s',test_pass=%d WHERE test_id=%d", $test_text,$test_pass,$test_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getTests()
{
    $query=sprintf("SELECT * FROM tbl_tests");
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getTest($test_id){
  $query = sprintf("SELECT * FROM tbl_tests WHERE test_id='%s'", $test_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}



function addTestGroup($test_id,$group_text){
  $query = sprintf("INSERT INTO tbl_testgroups   (test_id,group_text) VALUES (%d,'%s')",$test_id, $group_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteTestGroup($group_id){
  $query = sprintf("DELETE FROM tbl_testgroups WHERE  group_id= %d", $group_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editTestGroup($group_id,$group_text){
   $query = sprintf("UPDATE tbl_testgroups SET group_text='%s' WHERE group_id=%d", $group_text,$group_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getTestGroups($test_id)
{
    $query=sprintf("SELECT * FROM tbl_testgroups  WHERE test_id=%d order by group_id",$test_id);
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getTestGroup($group_id){
  $query = sprintf("SELECT * FROM tbl_testgroups WHERE group_id='%s'", $group_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}


function addTestQuestion($group_id,$question_text){
  $query = sprintf("INSERT INTO tbl_testquestions   (group_id,question_text) VALUES (%d,'%s')",$group_id, $question_text);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function deleteTestQuestion($question_id){
  $query = sprintf("DELETE FROM tbl_testquestions WHERE  question_id= %d", $question_id);
  if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}


function editTestQuestion($question_id,$question_text){
   $query = sprintf("UPDATE tbl_testquestions SET question_text='%s' WHERE question_id=%d", $question_text,$question_id);
   if (mysql_query($query)) {
    return "SUCCESS";
  }
  else {
    return mysql_error();
  }
}

function getTestQuestions($group_id)
{
    $query=sprintf("SELECT * FROM tbl_testquestions  WHERE group_id=%d order by question_id",$group_id);
    $result = mysql_query($query);
  $values = array();
  $i=0;
  while($row = mysql_fetch_array($result)) 
  {
    $values[] = $row;
  }
  return $values;
}

function getTestQuestion($question_id){
  $query = sprintf("SELECT * FROM tbl_testquestions WHERE question_id='%s'", $question_id);
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  return $row;
}

*/

function safe($value){ 
   return mysql_real_escape_string($value); 
} 