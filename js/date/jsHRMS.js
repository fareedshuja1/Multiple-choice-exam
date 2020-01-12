
var sDocumentFileName = "";

function AjaxPage(url, containerid)
{
    jQuery("#"+containerid).html('<br /><br /><div align="center"><img src="../images/loading.gif" /></div><br /><br />');
    jQuery("#"+containerid).load(url);
}

function HR_Common_Documents_AddNewDocument(sComponentName, iComponentId, sTitle, iAccessLevel, sFileName)
{
    if (sTitle.length <= 0)
        alert("Please enter the Title...");
    else if (sFileName.length <= 0)
        alert("Please upload a file first...");
    else if ((sFileName == "") || (sFileName == null) || (sFileName == "undefined"))
        alert("Please upload a file first!" + sFileName);
    else
        window.top.MOOdalBox.open("../common/documents.php?componentname=" + sComponentName + "&id=" + iComponentId + "&action=AddDocument&iAccessLevel=" + iAccessLevel + "&txtFileName=" + sFileName + "&txtTitle=" + sTitle, "Documents", "700 420");

    return(false);
}

// Employee Wizard
function EmployeeWizard(iStep)
{
    iTotalSteps = 8;
    //sData = "&selEmployeeType="+GetSelectedListBox("selEmployeeType");
    //sData += "&selEmployeeDesignation="+GetSelectedListBox("selEmployeeDesignation");
    //sData += "&selStation="+GetSelectedListBox("selStation");
    //sData += "&selDepartment="+GetSelectedListBox("selDepartment");
    
    HideDiv("divEmployeeWizardStep1");
    HideDiv("divEmployeeWizardStep2");
    HideDiv("divEmployeeWizardStep3");
    
    ShowDiv("divEmployeeWizardStep" + iStep);
    
    document.getElementById("divTitle").innerHTML = "Add New Employee [ Step " + iStep + " of " + iTotalSteps + " ]";
}

function AddNewEmployees(sMultipleEmployees, sListBoxName)
{
 	sAddEmployeesString = sMultipleEmployees;
    aMultipleEmployees = sMultipleEmployees.split("~");
 	for (i=0; i < aMultipleEmployees.length; i++)
 	{
 		aEmployeeInfo = aMultipleEmployees[i].split("|");
 		if (aEmployeeInfo.length > 2)
 		{
 			iEmployeeId = aEmployeeInfo[0];
 			sEmployeeName = aEmployeeInfo[1];
 			AddEmployeeToList(iEmployeeId, sEmployeeName, sListBoxName);
 		}
 	}
}

function RemoveSelectedEmployees(sListBoxName)
{
	if(document.getElementById(sListBoxName).selectedIndex < 0)
	{

	}
	else
	{
		var options = document.getElementById(sListBoxName).options;
		for( var i = options.length - 1; i >= 0; i-- )
			if( options[ i ].selected )
				options[ i ] = null;
		return false;
	}
}

function AddEmployees(sListBoxName)
{
	var listLength = document.getElementById(sListBoxName).length;
	for(i=0; i < listLength; i++)
		document.getElementById(sListBoxName).options[i].selected = true;

	document.getElementById('EmployeesString').value = sAddEmployeesString;
	return(true);
}

function AddEmployeeToList(iEmployeeId, sEmployeeName, sListBoxName)
{
 	maxLength = 100;

	list = document.getElementById(sListBoxName);
	var listLength = list.length;

	if ((listLength+1) > maxLength)
	{
		alert("Cannot add more than " + maxLength + " employees!");
		return false;
	}

	var targetIndex = listLength;
	
	for (x = 0; x < list.length; x++)
	    if (list.options[x].value == iEmployeeId)
	        return false;

	list.options[targetIndex] = new Option(iEmployeeId);
	list.options[targetIndex].value = iEmployeeId;
    list.options[targetIndex].text = sEmployeeName;
    
    return true;
}

function SelectEmployee(selListBoxName, iEmployeeId)
{
    document.getElementById(selListBoxName).value = iEmployeeId;
}

function GetEmployeeDetails()
{
    iEmployeeId = GetSelectedListBox("selEmployee");
    if(iEmployeeId > 0)
        xajax_AJAX_HR_Employees_Employees_GetEmployeeDetails(iEmployeeId);
}

function GetEmployeeJoiningDetails()
{
    iEmployeeId = GetSelectedListBox("selEmployee");
    if(iEmployeeId > 0)
    {
        //alert( iEmployeeId );
        xajax_AJAX_HR_Employees_Employees_GetEmployeeJoiningDetails(iEmployeeId);
    }
}

function GetEmployeeLeaves()
{
    iEmployeeId = GetSelectedListBox("selEmployee");
    if(iEmployeeId > 0)
        xajax_AJAX_HR_Employees_Leaves_GetEmployeeLeaves(iEmployeeId);
}

function GetScales()
{
    xajax_AJAX_HR_Employees_Employees_FillScales(GetSelectedListBox("selGrade"), "selScale");
}

function StatusHistory_ChangeAction(sAction)
{
    if (sAction == "Forward")
        ShowDiv("divForwardTo");
    else
        HideDiv("divForwardTo");
}


/* Forgot Your Password */
function ForgotPassword(sEmailAddress)
{
    if (!isEmailAddress(sEmailAddress))
        alert("Please enter a valid email address!");
    else
        window.top.MOOdalBox.open('../login/forgotpassword.php?action=RetrievePassword&txtEmailAddress='+sEmailAddress, 'Forgot Your Password ... ?', '550 220');
}

function SendFeedback(sName, sEmailAddress, sFeedback)
{
    if (sName == "")
        alert("Please enter your name!");
    else if (sFeedback == "")
        alert("Please enter your feedback!");
    else if (!isEmailAddress(sEmailAddress))
        alert("Please enter a valid email address!");
    else
        window.top.MOOdalBox.open('../include/feedback.php?action=SendFeedback&txtName='+sName+'&txtEmailAddress='+sEmailAddress+'&txtFeedback='+sFeedback, 'Send us your Feedback...', '550 320');
}

function ResetPassword()
{
  	if (GetVal('txtPassword') == "") return(AlertFocus('Please enter a valid Password', 'txtPassword'));
  	if (GetVal('txtPasswordConfirm') == "") return(AlertFocus('Please enter a valid Password', 'txtPasswordConfirm'));
  	if (GetVal('txtPassword') != GetVal('txtPasswordConfirm')) return(AlertFocus('Your two password should be the same!', 'txtPassword'));

   	return true;
}

function ShowHideMCQAnswers()
{
    iQuestionType = jQuery("#selQuestionType").val();
    
    if(iQuestionType == 0) jQuery("#divAddMCQAnswers").slideDown(800);
    else if(iQuestionType == 1) jQuery("#divAddMCQAnswers").slideUp(800);
}

function ChangeDashboardGraph(iGraphNumber)
{
    for (i=1; i <= 3; i++)
    {
        HideDiv("divDashboardGraph" + i);
        document.getElementById("imgDashboardGraph" + i).src = "../images/icons/iconBullet_Orange.png";
    }

    ShowDiv("divDashboardGraph" + iGraphNumber);
    document.getElementById("imgDashboardGraph" + iGraphNumber).src = "../images/icons/iconBullet_Green.png";
}


// Things to do
function ThingsToDo_ShowAddNewTask()
{
    HideDiv("divAddNewTaskButton");
    ShowDiv("divAddNewTask");
}

function ThingsToDo_ShowEditTask(iTaskId)
{
    HideDiv("divUpdateTask1_" + iTaskId);
    document.getElementById("divUpdateTask2_" + iTaskId).style.display = "inline";
}

function ThingsToDo_EditTask(iTaskId)
{
  	if (GetVal("txtEditTask_"+iTaskId) == "") return(AlertFocus('Please enter something...', 'txtEditTask_'+iTaskId));
 
    jQuery.colorbox({href:'../employees/thingstodo.php?action=EditTask&id='+encodeURIComponent(iTaskId)+'&txtTask='+encodeURIComponent(GetVal("txtEditTask_"+iTaskId)), width:'700px;', height:'620px;'});
    return(false);
}

function ThingsToDo_AddNewTask()
{
  	if (GetVal("txtAddNewTask") == "") return(AlertFocus('Please enter something...', 'txtAddNewTask'));
 
    jQuery.colorbox({href:'../employees/thingstodo.php?action=AddTask&txtTask='+encodeURIComponent(GetVal("txtAddNewTask")), width:'700px;', height:'620px;'});
    return(false);
}

function ThingsToDo_DeleteTask(iTaskId)
{
    jQuery.colorbox({href:'../employees/thingstodo.php?action=DeleteTask&id='+iTaskId, width:'700px;', height:'620px;'});
}

function ThingsToDo_ChangeStatus(iTaskId, iStatus)
{
    jQuery.colorbox({href:'../employees/thingstodo.php?action=ChangeStatus&id='+iTaskId+'&status='+iStatus, width:'700px;', height:'620px;'});
}


function ChangePayslipType(iPayslipType)
{
    jQuery("#divMonthlySalary").hide();
    jQuery("#divHourlyWages").hide();
    
    if (iPayslipType == 0)
        jQuery("#divMonthlySalary").show();
    else
        jQuery("#divHourlyWages").show();
}

/* Discussion */
function AddDiscussion()
{
    var sDiscussion = jQuery("#txtAddDiscussion").val();
    var sData = "type=Add&discussion=" + sDiscussion;
    
    jQuery('#imgLoading').show();

    jQuery.ajax({ 
        type: "POST", 
        url: "../employees/discussions2.php", data: sData,
        success: function(msg)
        {
            jQuery("#divDiscussions").html(msg);
            jQuery("#txtAddDiscussion").val("");
            jQuery("#divAddDiscussion").hide();
        }
    });
 
    jQuery('#imgLoading').hide();
        
    return(false);
}

function SearchDiscussions()
{
    var sSearch = jQuery("#search").val();
    
    if (sSearch == "")
    {
        jQuery("#divDiscussionsTitle").html("Recent Discussions");
        AjaxPage("../employees/discussions2.php?type=View", "divDiscussions");
    }
    else
    {
        jQuery("#divDiscussionsTitle").html("Search Results for " + sSearch);
        AjaxPage("../employees/discussions2.php?type=View&p=" + encodeURIComponent(sSearch), "divDiscussions");
    }
    
    return(false);
}

function DiscussionsMore(iPageNo, sSearch)
{
    AjaxPage("../employees/discussions2.php?type=View&p="+encodeURIComponent(sSearch)+"&pno="+iPageNo, "divDiscussions"+iPageNo);
}

function DeleteDiscussion(iDiscussionId)
{
    if (confirm("Do you really want to delete this discussion and all of its replies?"))
    {  
        var sData = "type=Delete&id=" + iDiscussionId;
        
        jQuery.ajax({ 
            type: "POST", 
            url: "../employees/discussions2.php", data: sData,
            success: function(msg)
            {
                if (msg == "SUCCESS")
                {
                    jQuery("#divDiscussionThread_"+iDiscussionId).hide("slow");
                }
            }
        });
    }
}

function DiscussionReplies(iDiscussionId)
{
    if (jQuery("#divDiscussionThreadReplies_"+iDiscussionId).is(":visible"))
    {
        jQuery("#divDiscussionThreadReplies_"+iDiscussionId).hide("slow");
    }
    else
    {
        AjaxPage("../employees/discussions2.php?type=Replies&id="+iDiscussionId, "divDiscussionThreadReplies_"+iDiscussionId);
        jQuery("#divDiscussionThreadReplies_"+iDiscussionId).show("slow");
    }
}

function DiscussionReplyAddShow(iDiscussionId)
{
    if (jQuery("#divDiscussionReplyAdd_"+iDiscussionId).is(":visible"))
        jQuery("#divDiscussionReplyAdd_"+iDiscussionId).hide("slow");
    else
        jQuery("#divDiscussionReplyAdd_"+iDiscussionId).show("slow");
}

function DiscussionReplyAdd(iDiscussionId)
{
    var sDiscussionReply = jQuery("#txtDiscussionReply_"+iDiscussionId).val();
    var sData = "type=AddReply&id="+iDiscussionId+"&reply="+sDiscussionReply;

    jQuery('#imgReplyLoading_'+iDiscussionId).show();
    
    jQuery.ajax({ 
        type: "POST", 
        url: "../employees/discussions2.php", data: sData,
        success: function(msg)
        {
            jQuery("#divDiscussionThreadReplies_"+iDiscussionId).html(msg);
        }
    });
 
    jQuery('#imgReplyLoading_'+iDiscussionId).hide();
        
    return(false);
}

function DeleteDiscussionReply(iDiscussionId, iDiscussionReplyId)
{
    if (confirm("Do you really want to delete this reply?"))
    {  
        var sData = "type=DeleteReply&id=" + iDiscussionId + "&replyid=" + iDiscussionReplyId;
        
        jQuery.ajax({ 
            type: "POST", 
            url: "../employees/discussions2.php", data: sData,
            success: function(msg)
            {
                if (msg == "SUCCESS")
                {
                    jQuery("#divDiscussionThreadReply_"+iDiscussionReplyId).hide("slow");
                }
            }
        });
    }
}

function ChangeLeaveDuration()
{
    iLeaveDuration = jQuery("#selLeaveDuration").val();
    
    if (iLeaveDuration == 0) // Full Day Leave
    {
        jQuery("#trLeaveFrom").show();
        jQuery("#trLeaveTo").show();
        
        jQuery("#trHalfDayLeaveDate").hide();
        jQuery("#trHalfDayLeavePeriod").hide();
    }
    else if (iLeaveDuration == 1) // Half Day Leave
    {
        jQuery("#trHalfDayLeaveDate").show();
        jQuery("#trHalfDayLeavePeriod").show();

        jQuery("#trLeaveFrom").hide();
        jQuery("#trLeaveTo").hide();
    }
}

function EmployeeLeavesQuota()
{
    var iEmployeeId = jQuery("#selEmployee").val();
    window.top.jQuery.colorbox({href:'../home/pages.php?page=Employees_Leaves_LeavesQuota&id='+iEmployeeId, width:'550px;', height:'400px;'});
}

function UpdateLeavesQuota(iEmployeeId, iLeaveTypeId, sLeavesLeft)
{
    jQuery("#imgUpdateQuota_" + iLeaveTypeId).attr("src", "../images/loading.gif");
    window.top.jQuery.colorbox({href:'../home/pages.php?page=Employees_Leaves_LeavesQuota_UpdateQuota&id='+iEmployeeId+'&leavetype='+iLeaveTypeId+'&leavesleft='+sLeavesLeft, width:'550px;', height:'400px;'});
}

function ChangeLeaveCarryOverYear()
{
    var iYear = jQuery("#selYear").val();
    window.top.jQuery.colorbox({href:'../home/pages.php?page=Employees_Leaves_LeavesCarryOver&year='+iYear, width:'650px;', height:'440px;'});
}

function ResetLeavesQuota()
{
    if(confirm('Do you really want to Reset the Leaves Quota?'))
    {
        window.top.jQuery.colorbox({href:'../home/pages.php?page=Employees_Leaves_ResetLeavesQuota_ConfirmReset', width:'550px;', height:'280px;'});
    }
}

/* Social Performance */

function SocialPerformanceChangeUser(iEmployeeId)
{
    for (i=0; i < iSocialPerformanceEmployees; i++)
    {
        jQuery("#trEmployees_"+aSocialPerformance[i][0]).css("background-color", "#57769c");
        jQuery("#imgArrow_"+aSocialPerformance[i][0]).hide();
    }

    jQuery("#trEmployees_"+iEmployeeId).css("background-color", "#314b6a");
    jQuery("#imgArrow_"+iEmployeeId).show();
    
    AjaxPage("../employees/socialperformance2.php?page=Profile&id="+iEmployeeId, "divMainContainer");
}

/* Reports */

function Reports(sReportType, sReportName, sExtraParams)
{
    jQuery("div#divReportButtons a").css({"color":"#000000", "font-weight":"normal"});
    jQuery("#a" + sReportName).css({"color":"#0000ff", "font-weight":"bold"});
    
    AjaxPage("../reports/reports.php?type=" + sReportType + "&report=" + sReportName + sExtraParams, "divReportsContainer");
}

/* News Feed */

function NewsFeedMore(iEmployeeId, iPageNo)
{
    AjaxPage("../home/pages.php?page=NewsFeed_Items&id="+iEmployeeId+"&pno="+iPageNo, "divNewsFeed"+iPageNo);
}



var imgMaximize = "../images/icons/iconDown.png";
var imgMinimize = "../images/icons/iconUp.png";

function MinMax(sImageId, sBlockId)
{
    if (jQuery("#" + sImageId).attr("src") == imgMaximize)
        Maximize(sImageId, sBlockId);
    else
        Minimize(sImageId, sBlockId);
}

function Minimize(sImageId, sBlockId)
{
    jQuery("#" + sBlockId).slideUp(800);
    jQuery("#" + sImageId).attr("src", imgMaximize);
}

function Maximize(sImageId, sBlockId)
{
    jQuery("#" + sBlockId).slideDown(800);
    jQuery("#" + sImageId).attr("src", imgMinimize);
}


function ChangePage(sPageURL)
{
    jQuery("#divContainerMain").html('<div align="center"><img style="margin-top:120px; margin-bottom:200px;" src="../images/loading.gif" /></div>');
    jQuery("#divContainerMain").load(sPageURL);
}

function WebHRSearch(sSearch)
{
    AjaxPage("../home/pages.php?page=Search&search=" + encodeURIComponent(sSearch), "divWebHRSearchResults");
    return(false);
}


function Message(sMessage)
{
    aMessage = sMessage.split("|");

    iMessageType = aMessage[0];
    sMessage = aMessage[1];
    
    if (iMessageType == 1)      // Warning
    {
        var sTableColor = "#FFFFA9";
        var sImage = "../images/icons/iconWarning.png";
    }
    else if (iMessageType == 2)   // Success
    {
        var sTableColor = "#C4D2F7";
        var sImage = "../images/icons/iconInformation.png";
    }

    sReturn = '<div id="divInfoWindow"><br /><table width="80%" bgcolor="' + sTableColor + '" border="1" bordercolor="#C0C0C0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" align="center"><tr><td><table width="100%" border="0" align="center" cellspacing="0" cellpadding="0"><tr><td align="center" style="width:40px; height:50px;"><img src="' + sImage + '" border="0" /></td><td align="center" valign="middle" style="font-family:Trebuchet MS, Arial; font-size:12px;">' + sMessage + '</td><td style="width:16px;" valign="top" align="center"><a href="#noanchor" onclick="jQuery(\'#divInfoWindow\').slideUp(800);"><img src="../../hr/images/icons/iconClose.png" border="0" alt="Close" title="Close" /></a>&nbsp;</td></tr></table></td></tr></table><br /></div>';
    
    return(sReturn);
}

function AccessDenied()
{
    jQuery("#dialog:ui-dialog").dialog("destroy");
	jQuery("#divAccessDenied").dialog({
		resizable: false,
		height:240,
		width:320,
		modal: true
	});
}

function RecruitCandidate(iJobCandidateId)
{
    var sUserName = jQuery("#txtUserName").val();
    var sPassword = jQuery("#txtPassword").val();
    var iEmployeeType = jQuery("#selEmployeeType").val();
    var iEmployeeCategory = jQuery("#selEmployeeCategory").val();
    var iEmployeeDesignation = jQuery("#selEmployeeDesignation").val();
    var iEmployeeGrade = jQuery("#selEmployeeGrade").val();
    var iStation = jQuery("#selStation").val();
    var iDepartment = jQuery("#selDepartment").val();
    var iWorkShift = jQuery("#selShift").val();
    
  	if (sUserName == "") return(AlertFocus('Please enter a valid User Name', 'txtUserName'));
  	if (sPassword == "") return(AlertFocus('Please enter a valid Password', 'txtPassword'));
  	if (iEmployeeType <= 0) return(AlertFocus('Please select a valid Employee Type', 'selEmployeeType'));
  	if (iEmployeeCategory <= 0) return(AlertFocus('Please select a valid Employee Category', 'selEmployeeCategory'));
  	if (iEmployeeDesignation <= 0) return(AlertFocus('Please select a valid Employee Designation', 'selEmployeeDesignation'));
  	if (iEmployeeGrade <= 0) return(AlertFocus('Please select a valid Employee Grade', 'selEmployeeGrade'));
  	if (iStation <= 0) return(AlertFocus('Please select a valid Station', 'selStation'));
  	if (iDepartment <= 0) return(AlertFocus('Please select a valid Department', 'selDepartment'));
  	if (iWorkShift <= 0) return(AlertFocus('Please select a valid Work Shift', 'selShift'));
  	
  	var sFields = "&txtUserName="+encodeURIComponent(sUserName)+"&txtPassword="+encodeURIComponent(sPassword)+"&selEmployeeType="+encodeURIComponent(iEmployeeType)+"&selEmployeeCategory="+encodeURIComponent(iEmployeeCategory)+"&selEmployeeDesignation="+encodeURIComponent(iEmployeeDesignation)+"&selEmployeeGrade="+encodeURIComponent(iEmployeeGrade)+"&selStation="+encodeURIComponent(iStation)+"&selDepartment="+encodeURIComponent(iDepartment)+"&selWorkShift="+encodeURIComponent(iWorkShift);
    window.top.jQuery.colorbox({href:'../home/pages.php?page=Recruitment_JobCandidates_ConfirmRecruitCandidate&id='+iJobCandidateId+'&action=RecruitCandidate'+sFields, width:'600px;', height:'350px;'});

    return(false);
}

function PerformanceEvaluationQuestions(iPerformanceEvaluationId, iPerformanceEvaluationQuestionId, sAction)
{
    var sFields;
    
    var sQuestion = jQuery("#txtQuestion").val();
    var iQuestionType = jQuery("#selQuestionType").val();
    
    var sChoice1 = jQuery("#txtChoice1").val();
    var sChoice2 = jQuery("#txtChoice2").val();
    var sChoice3 = jQuery("#txtChoice3").val();
    var sChoice4 = jQuery("#txtChoice4").val();
    var sChoice5 = jQuery("#txtChoice5").val();
    var iAllowComments = jQuery("#selAllowComments").val();
    var iMandatoryQuestion = jQuery("#selMandatoryQuestion").val();
    var iQuestionOrder = jQuery("#txtQuestionOrder").val();
    
    var iChoice1Score = jQuery("#selChoice1Score").val();
    var iChoice2Score = jQuery("#selChoice2Score").val();
    var iChoice3Score = jQuery("#selChoice3Score").val();
    var iChoice4Score = jQuery("#selChoice4Score").val();
    var iChoice5Score = jQuery("#selChoice5Score").val();
    
    if (sQuestion == "") { alert("Please enter a valid Question"); jQuery("#txtQuestion").focus(); return(false); }
    
    sFields = "&q=" + encodeURIComponent(sQuestion);
    sFields += "&t=" + encodeURIComponent(iQuestionType);
    sFields += "&c1=" + encodeURIComponent(sChoice1);
    sFields += "&c2=" + encodeURIComponent(sChoice2);
    sFields += "&c3=" + encodeURIComponent(sChoice3);
    sFields += "&c4=" + encodeURIComponent(sChoice4);
    sFields += "&c5=" + encodeURIComponent(sChoice5);
    sFields += "&c=" + encodeURIComponent(iAllowComments);
    sFields += "&m=" + encodeURIComponent(iMandatoryQuestion);
    sFields += "&o=" + encodeURIComponent(iQuestionOrder);
    sFields += "&c1s=" + encodeURIComponent(iChoice1Score);
    sFields += "&c2s=" + encodeURIComponent(iChoice2Score);
    sFields += "&c3s=" + encodeURIComponent(iChoice3Score);
    sFields += "&c4s=" + encodeURIComponent(iChoice4Score);
    sFields += "&c5s=" + encodeURIComponent(iChoice5Score);
    
    jQuery.colorbox({href:'../home/pages.php?page=Employees_PerformanceEvaluation_Questions_Operations&componenttitle=PerformanceEvaluation&id='+iPerformanceEvaluationId+'&qid='+iPerformanceEvaluationQuestionId+'&action='+sAction+sFields, width:'700px;', height:'320px;'});
    return false;
}

function PerformanceEvaluationEmployeesEvaluations(iPerformanceEvaluationId, iPerformanceEvaluationEmployeesEvaluationId, sAction)
{
    var sFields;
    
    var sEvaluationTitle = jQuery("#txtEvaluationTitle").val();
    
    var sEvaluationFor = jQuery("#selEvaluationFor").val();
    var sEvaluationBy = jQuery("#selEvaluationBy").val();
    
    var sEvaluationStartDate = jQuery("#txtEvaluationStartDate").val();
    var sEvaluationEndDate = jQuery("#txtEvaluationEndDate").val();
    
    var iSendNotification = (jQuery("#chkSendNotification").prop("checked")) ? 1 : 0;
    
    if (sEvaluationTitle == "") { alert("Please enter a valid Title for your Evaluation"); jQuery("#txtEvaluationTitle").focus(); return(false); }
    if (sEvaluationFor == null) { alert("Please select atleast one employee in Evaluation For field"); jQuery("#selEvaluationFor").focus(); return(false); }
    if (sEvaluationBy == null) { alert("Please select atleast one employee in Evaluation By field"); jQuery("#selEvaluationBy").focus(); return(false); }
    
    sFields = "&t=" + encodeURIComponent(sEvaluationTitle);
    sFields += "&by=" + encodeURIComponent(sEvaluationBy);
    sFields += "&for=" + encodeURIComponent(sEvaluationFor);
    sFields += "&st=" + encodeURIComponent(sEvaluationStartDate);
    sFields += "&en=" + encodeURIComponent(sEvaluationEndDate);
    sFields += "&n=" + encodeURIComponent(iSendNotification);
    
    jQuery.colorbox({href:'../home/pages.php?page=Employees_PerformanceEvaluation_EmployeesEvaluations_Operations&componenttitle=PerformanceEvaluation&id='+iPerformanceEvaluationId+'&eid='+iPerformanceEvaluationEmployeesEvaluationId+'&action='+sAction+sFields, width:'700px;', height:'320px;'});
    return false;
}

function FillPerformanceEvaluation(iPerformanceEvaluationId, iPerformanceEvaluationEmployeesEvaluationId, sEvaluationCode, iNumberOfQuestions)
{
    var sFields = "";
    var iQuestionId;
    var iQuestionType;
    var iMandatoryQuestion;
    var iScore;    
    var iAnswer;
    var iAllowComments;
    var sComments;
    
    for (i=0; i < iNumberOfQuestions; i++)
    {
        iAnswer = 0;
        iScore = 0;
        iAllowComments = 0;
        sComments = "";
        
        iQuestionId = jQuery("#hdnQuestionId_"+i).val();
        iQuestionType = jQuery("#hdnQuestionType_"+i).val();
        iMandatoryQuestion = jQuery("#hdnMandatoryQuestion_"+i).val();
        iAllowComments = jQuery("#hdnQuestion_" + i + "_AllowComments").val();
        sComments = encodeURIComponent(jQuery("#Answer" + i + "_Comments").val());
        
        if (iQuestionType == 0)     // Radio Select
        {
            iAnswer = jQuery("input[name='Answer" + i + "']:checked").val();
            iScore = jQuery("#hdnChoice" + iAnswer + "Score_" + i).val();
        }
        else if (iQuestionType == 1)    // Checkbox Select
        {
            iAnswer = ((jQuery("#Answer"+i+"_1").prop("checked")) ? 1 : 0) + "|" + ((jQuery("#Answer"+i+"_2").prop("checked")) ? 1 : 0) + "|" + ((jQuery("#Answer"+i+"_3").prop("checked")) ? 1 : 0) + "|" + ((jQuery("#Answer"+i+"_4").prop("checked")) ? 1 : 0) + "|" + ((jQuery("#Answer"+i+"_5").prop("checked")) ? 1 : 0);
            iScore = 0;
        }
        else if (iQuestionType == 2)    // Text
        {
            iAnswer = encodeURIComponent(jQuery("#Answer"+i).val());
            iScore = 0;
        }
        
        if ((!iAnswer) || (iAnswer == "0|0|0|0|0"))
        {
            if (iMandatoryQuestion == 1)
            {   
                jQuery("html,body").animate({scrollTop: jQuery("#divQuestion"+i).offset().top},"slow");
                return(false);
            }
            else
                iAnswer = 0;
        }
        
        sFields += "&q" + (i+1) + "=" + iQuestionId + "&qt" + (i+1) + "=" + iQuestionType + "&a" + (i+1) + "=" + iAnswer + "&s" + (i+1) + "=" + iScore + "&ac" + (i+1) + "=" + iAllowComments + "&c" + (i+1) + "=" + sComments;
    }

    AjaxPage("../home/pages.php?page=Employees_PerformanceEvaluation_SubmitPerformanceEvaluation&id="+iPerformanceEvaluationId+"&eid="+iPerformanceEvaluationEmployeesEvaluationId+"&no="+iNumberOfQuestions+"&code="+sEvaluationCode+sFields, "divEvaluationQuestions");
    return(false);
}