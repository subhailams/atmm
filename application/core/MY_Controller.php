<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layoutfolder = $this->config->item("layoutfolder");
        //$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
        $this->ValidateForm("Y");
        $this->UserFrom();
        $config = array("question_format" => "numeric",
            "operation" => "addition");
        $this->mathcaptcha->init($config);
        $userNameCnd = array("stp_username" => $this->session->userdata("UserName"));
        //$this->user = current($this->Adminmodel->CSearch($userNameCnd, "stp_username as UserName", "stp"));
       //$this->userid = current($this->Adminmodel->CSearch($userNameCnd, "stp_id as UserId", "stp"));
        //$this->userRole = current($this->Adminmodel->CSearch($userNameCnd, "stp_role as UserRole", "stp", "", TRUE));
        //$this->userDesg = current($this->Adminmodel->CSearch($userNameCnd, "des_name as Desgination", "stp", "", TRUE));
        date_default_timezone_set('Asia/Kolkata');
    }


    protected function UserFrom() {
        if ($this->agent->is_browser()) {
            $this->UserAcess = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $this->UserAcess = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $this->UserAcess = $this->agent->mobile();
        } else {
            $this->UserAcess = 'Unidentified User Agent';
        }
    }

    public function render($Render, $RenderData = null) {
        $Layout = "layout/body";
        $this->render = $Render;
        $this->load->view($Layout, $RenderData);
    }

    protected function ValidateForm($runType = "Y", $DataValidateto = null) {
        $notValidate = ($runType == "Y") ? array("ChangeSesi", "SysLog", "init", "Log") : array();
        if (!in_array($this->router->fetch_method(), $notValidate)) {
            $ArgStatus = $this->arg_validate->ValidateData($this->router->fetch_method(), $DataValidateto);
            if (!$ArgStatus) {
                $error = implode("", (array) $this->FormError + array("header" => $this->input->is_ajax_request()));
                $error = str_replace(array("\n", "\r"), "", $error);
                if ($this->input->is_ajax_request()) {
                    $this->apirender->ThowError($error, null);
                } else {
                    $this->apirender->ThowError($error, null);
                }
            }
        }
    }

    public function Inti($Class) {
        $ClassNo = array(array("register"), "homepage" => array("forgotpwd"));
        if (!(in_array($this->router->fetch_method(), $ClassNo[$Class]))) {
            if (empty($_SESSION["UserId"])) {
                $AuthVal = $this->auth->Authencation("Y", "error");
                if (!$AuthVal) {
                    $this->session->set_flashdata('LoginError', 'User Name or Password is not matches');
                    redirect("/");
                }
            }
        }
        $CtrlRole = $this->db->where(array("stp_id" => $_SESSION["UserId"]))->join("user_role", "role_id=stp_role")->get("staffprofile")->row_array();
        if ((!empty($CtrlRole)) && ($CtrlRole['role_name'] == strtoupper($Class))) {
            if (strtoupper($_SESSION["UserRole"]) == strtoupper($Class)) {
                return true;
            } else {
                redirect("/" . strtolower($CtrlRole['role_name']) . "/index");
            }
        } else {
            if (!empty($CtrlRole['role_name'])) {
                redirect("/" . strtolower($CtrlRole['role_name']) . "/index");
            } else {
                redirect("/error/index/InitiThrought");
            }
        }
    }

    public function Logout() {
        $this->session->sess_destroy();
        session_unset();
        session_destroy();
        $this->session->set_userdata("Auth", "Y");
        $this->session->set_userdata("UserName", null);
        $this->session->set_userdata("UserFullName", null);
        $this->session->set_userdata("UserID", null);
        $this->session->set_userdata("UserType", null);
        $this->session->set_userdata("UserRoleID", null);
        $this->session->set_userdata("UserRoleName", null);
        $this->session->set_userdata("DepartmentName", null);
        $this->session->set_userdata("DepartmentID", null);
        $this->session->set_userdata("DesgName", null);
        $this->session->set_userdata("DesgShortName", null);
        $this->session->set_userdata("AcademicYear", null);
        $this->session->set_userdata("AcademicYearFull", null);
        exit($this->load->view("error/login", get_defined_vars(), true));
    }

    public function accessdeined() {
        $this->render("accessdeined", get_defined_vars());
    }

    public function SendEmail($EmailTo, $Message, $ReturnData, $Subject, $EmailBcc) {

        $mail = $this->emailConfig();
        $mail->setFrom('vidhyaprakash85@gmail.com', 'Mailer');
        $mail->addAddress($EmailTo);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $Subject;
        $mail->Body = $Message;

        if (!$mail->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function emailConfig() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'vidhyaprakash85@gmail.com';                 // SMTP username
        $mail->Password = 'prakash88';
        return $mail;
    }

    public function DatatableGridHeader($Url, $Colmn, $RowShow = 5, $title = null, $ServerData = null) {
        $Postdata = $this->input->post(null, true);
        $Tableid = uniqid(round(microtime(true) * 1000) . rand() . "Table_");
        $tmpl = array(
            'table_open' => '<table id="' . $Tableid . '" class="table datatableD table-striped table-bordered table-condensed">',
            'table_close' => '<tbody></tbody></table>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_heading($Colmn);
        $Table['html'] = $this->table->generate();

        $Table['script'] = build_datatable($Tableid, site_url($this->router->fetch_class() . '/GridDataSource/' . $Url), $ServerData);

        return $Table;
    }

    public function forms($option) {
        switch (strtolower($option)):
            case "password_reset":
                $this->render(strtolower($option), get_defined_vars());
                break;
        endswitch;
    }

    public function generateChartData() {
        $TotalAcademicYear = $this->Adminmodel->CSearch("", "aca_id as AcademicID,aca_name as Year", "aca", "Y");
        foreach ($TotalAcademicYear as $AcademicYear) {
            $PartAInformation = array("InteralMarkODD" => $this->PartAAcademicInternalTestOddScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "UniversityMarkODD" => $this->PartAAcademicUniversityTestOddScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "FeedBackMarkODD" => $this->PartAAcademicFeedBackOddScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "InteralMarkEVEN" => $this->PartAAcademicInternalTestEvenScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "UniversityMarkEVEN" => $this->PartAAcademicUniversityTestEvenScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "FeedBackMarkEVEN" => $this->PartAAcademicFeedBackEvenScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "FDP" => $this->PartAFDPScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "ProfessionalSoc" => $this->PartAMembershipScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
            );

            $PartBInformation = array(
                "PatentApplied" => $this->PatentAppliedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "PatentObtained" => $this->PatentObatinedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "PublicationInternational" => $this->PaperPresentedReputedJournalScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "PublicationOther" => $this->PaperPresentedOtherJournalScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "PapersPresentedConference" => $this->PaperPresentedConferenceScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "ConferenceOrganizedScore" => $this->ConferenceOrganizedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "BooksPublishedReputed" => $this->BooksPublishedReputedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "BooksPublishedOther" => $this->BooksPublishedOtherScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "SponsoredProjectsApplied" => $this->SponsoredProjectsAppliedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "SponsoredProjectsGranted" => $this->SponsoredProjectGrantedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "ConsultancyProjectsCompleted" => $this->ConsultancyProjectsCompletedScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
                "ResearchGuidance" => $this->ResearchGuidanceScore($AcademicYear['AcademicID'], $_SESSION['UserId']),
            );
            $PartcScore = $this->PartCScore($AcademicYear['AcademicID'], $_SESSION['UserId']);
            $data[] = array(
                "{ACA: '" . $AcademicYear['Year'] . "'",
                'A:' . array_sum($PartAInformation),
                'B:' . array_sum($PartBInformation),
                'C:' . $PartcScore . "}",
            );
        }
        return $data;
    }

    public function approval($option, $id) {
        switch (strtolower($option)):
            case "parta_academic":
                $Data = $this->fetch_academic_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "parta_fdp":
                $Data = $this->fetch_fdp_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "parta_membership":
                $Data = $this->fetch_membership_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_conference":
                $Data = $this->fetch_conference_organized_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_research":
                $Data = $this->fetch_research_publication_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_paper":
                $Data = $this->fetch_paper_presented_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_books":
                $Data = $this->fetch_books_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_sponsored":
                $Data = $this->fetch_sponsored_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_consultancy":
                $Data = $this->fetch_consultancy_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_patent":
                $Data = $this->fetch_patent_approval_data($_SESSION['DepartmentID'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            default :
                redirect('/' . strtolower($this->router->fetch_class()));
                break;
        endswitch;
    }

    protected function fetch_academic_approval_data($DepartmentID, $AcademicYear) {
        $Select = "stp_id as StaffID,stp_name as StaffName,sem_id as SEMID,sem_name as SemesterName,anx1_id as RecordID,anx1_subname as SubjectName,anx1_test1_app as T1A,anx1_test2_app as T2A,anx1_test1_pas as T1P,anx1_test2_pas as T2P,anx1_model_app as MA,anx1_model_pas as MP,anx1_univ_perc as UnivPER,anx1_fdbk_perc as FeedPer";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y");
    }

    protected function fetch_fdp_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_program_name as ProgramName,anx1_place as Place,anx1_duration as Duration,anx1_spon_agency as SponsoringAgency,anx1_proof as FDP_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_fdp", "Y", "Y");
    }

    protected function fetch_membership_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_membership_name as MemberShipName,mem_name as MemberShipType,anx1_membership_type as MemberShipTypeID,anx1_proof as Membership_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_ms", "Y", "Y");
    }

    protected function fetch_conference_organized_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_sponsor_agy as SponsoringAgency,anx1_conference_title as ConferenceTitle,anx1_conference_type as EventLevel,anx1_year as YearParticipation,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_cf", "Y", "Y");
    }

    protected function fetch_research_publication_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_paper_title as PaperTitle,anx1_journal_name as JournalName,anx1_year_pub as YearPublished,anx1_imapct_factor as ImpactFactor,anx1_journal_type as JournalType,jot_short_name as JournalShortName,anx1_proof as Research_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_rs", "Y", "Y");
    }

    protected function fetch_paper_presented_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_paper_title as PaperTitle,anx1_conf_title as ConferenceTitle,eve_id as EventID,eve_name as EventLevel,anx1_proof as Paper_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_pp", "Y", "Y");
    }

    protected function fetch_books_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_book_name as BookName,anx1_author_name as AuthorName,anx1_area_spec as AreaSpecialization,anx1_publisher_name as PublisherName,anx1_year as YearPublishing,bty_id as BookType,bty_short_name as BookShortName,anx1_proof as Book_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_bk", "Y", "Y");
    }

    protected function fetch_sponsored_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_title as Title,anx1_amount as Amount,anx1_agency as SponsoringAgency,anx1_coordinator as ProjectCoordinators,anx1_status as ProjectStatus,pst_name as ProjectStatusName,anx1_proof as Sponsored_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_sd", "Y", "Y");
    }

    protected function fetch_consultancy_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_title as Title,anx1_amount as Amount,anx1_client as ClientOrganization,anx1_coordinator as ProjectCoordinators,anx1_status as ProjectStatus,pst_name as ProjectStatusName,anx1_proof as Consultancy_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_cs", "Y", "Y");
    }

    protected function fetch_patent_approval_data($DepartmentID, $AcademicYear) {
        $Select = "anx1_id as RecordID,anx1_title as PatentName,pat_id as PatentType,anx1_proof as Patent_Proof,approvalstatus as ApprovalStatus,stp_name as FacultyName";
        $Condition = array("anx1_acayear" => $AcademicYear, "dept_id" => $DepartmentID, "approvalstatus" => 0, "des_short_name!=" => "H");
        return $this->Adminmodel->CSearch($Condition, $Select, "ax_pat", "Y", "Y");
    }

    public function assessmentforms($option, $id) {
        switch (strtolower($option)):
            case "generalinformation":
                $Data = $this->fetch_Data("generalinformation", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "parta_academic":
                $Data = $this->fetch_Data("parta_academic", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "parta_fdp":
                $Data = $this->fetch_Data("parta_fdp", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "parta_membership":
                $Data = $this->fetch_Data("parta_membership", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_research":
                $Data = $this->fetch_Data("partb_research", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_paper":
                $Data = $this->fetch_Data("partb_paper", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_conference":
                $Data = $this->fetch_Data("partb_conference", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_books":
                $Data = $this->fetch_Data("partb_books", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_sponsored":
                $Data = $this->fetch_Data("partb_sponsored", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_consultancy":
                $Data = $this->fetch_Data("partb_consultancy", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_researchguidance":
                $Data = $this->fetch_Data("partb_researchguidance", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partc_leadership":
                $Data = $this->fetch_Data("partc_leadership", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partc_leadership_top":
                $Data = $this->fetch_Data("partc_leadership_top", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partb_patent":
                $Data = $this->fetch_Data("partb_patent", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "partd_hod_assessment":
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "viewmessage":
                $MessageSelect = "msg_title as MessageTitle, msg_details as MessageBody";
                $MessageCondition = array("msg_id" => $this->encrypt->decode($id), "msg_aca_year" => $_SESSION['AcademicYear']);
                $Data = $this->Adminmodel->CSearch($MessageCondition, $MessageSelect, "msg"); //Professional data
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "changeacademicyear":
                $PostData = $this->input->post();
                $Data = $this->changeAcademicYear($PostData['academicyear']);
                if (!empty($Data)):
                    $this->session->set_userdata("AcademicYear", $Data['AcademicID']);
                    $this->session->set_userdata("AcademicYearFull", $Data['AcademicYear']);
                    $this->session->set_flashdata('ME_SUCCESS', 'Academic Year Changed Successfully');
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()));
                break;
            default :
                redirect('/' . strtolower($this->router->fetch_class()));
                break;
        endswitch;
    }

    public function changeAcademicYear($AcademicYear) {
        $AcademicYear = $this->encrypt->decode($AcademicYear);
        $AcademicSelect = "aca_id as AcademicID, aca_name as AcademicYear";
        $AcademicCondition = array("aca_id" => $AcademicYear);
        return $this->Adminmodel->CSearch($AcademicCondition, $AcademicSelect, "aca"); //Professional data
    }

    public function fetch_Data($option, $UserRef, $AcademicYear, $Report) {
        switch (strtolower($option)) {
            case "generalinformation":
                $Select = "stp_name as Name,stp_dept as DepartmentID,stp_desg as DesignationID,stp_qual as QualID,stp_dob as DateofBirth,stp_doj as DateofJoin,stp_rmk_exp as RMKEXP,stp_oth_exp as OtherExp,stp_ind_exp as IndExp,dept_name as Department,des_name as Designation,qua_name as Qualification";
                $Condition = array("stp_username" => $this->user);
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "stp", "", "Y");
                break;
            case "parta_academic":
                $Select = "anx1_id as RecordID,anx1_sem as SemsterName,anx1_subname as SubjectName,anx1_test1_app as T1A,anx1_test2_app as T2A,anx1_test1_pas as T1P,anx1_test2_pas as T2P,anx1_model_app as MA,anx1_model_pas as MP,anx1_univ_perc as UnivPER,anx1_fdbk_perc as FeedPer,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y");
                break;
            case "parta_academic_odd":
                $Select = "anx1_inte_perc as InteralPercentage,anx1_subname as SubjectName,anx1_test1_app as T1A,anx1_test2_app as T2A,anx1_test1_pas as T1P,anx1_test2_pas as T2P,anx1_model_app as MA,anx1_model_pas as MP,anx1_univ_perc as UnivPER,anx1_fdbk_perc as FeedPer";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "sem_name" => "ODD", "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "sem_name" => "ODD");
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y");
                break;
            case "parta_academic_even":
                $Select = "anx1_inte_perc as InteralPercentage,anx1_subname as SubjectName,anx1_test1_app as T1A,anx1_test2_app as T2A,anx1_test1_pas as T1P,anx1_test2_pas as T2P,anx1_model_app as MA,anx1_model_pas as MP,anx1_univ_perc as UnivPER,anx1_fdbk_perc as FeedPer";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "sem_name" => "EVEN", "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "sem_name" => "EVEN");
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y");
                break;
            case "parta_fdp":
                $Select = "anx1_id as RecordID,anx1_program_name as ProgramName,anx1_place as Place,anx1_duration as Duration,anx1_spon_agency as SponsoringAgency,anx1_proof as FDP_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_fdp", "Y", "Y");
                break;
            case "parta_membership":
                $Select = "anx1_id as RecordID,anx1_membership_name as MemberShipName,mem_name as MemberShipType,anx1_membership_type as MemberShipTypeID,anx1_proof as Membership_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_ms", "Y", "Y");
                break;
            case "partb_research":
                $Select = "anx1_id as RecordID,anx1_paper_title as PaperTitle,anx1_journal_name as JournalName,anx1_year_pub as YearPublished,anx1_imapct_factor as ImpactFactor,anx1_journal_type as JournalType,jot_short_name as JournalShortName,anx1_proof as Research_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_rs", "Y", "Y");
                break;
            case "partb_paper":
                $Select = "anx1_id as RecordID,anx1_paper_title as PaperTitle,anx1_conf_title as ConferenceTitle,eve_id as EventID,eve_name as EventLevel,anx1_proof as Paper_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_pp", "Y", "Y");
                break;
            case "partb_conference":
                $Select = "anx1_id as RecordID,anx1_sponsor_agy as SponsoringAgency,anx1_conference_title as ConferenceTitle,anx1_conference_type as EventLevel,anx1_year as YearParticipation,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_cf", "Y", "Y");
                break;
            case "partb_books":
                $Select = "anx1_id as RecordID,anx1_book_name as BookName,anx1_author_name as AuthorName,anx1_area_spec as AreaSpecialization,anx1_publisher_name as PublisherName,anx1_year as YearPublishing,bty_id as BookType,bty_short_name as BookShortName,anx1_proof as Book_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_bk", "Y", "Y");
                break;
            case "partb_sponsored":
                $Select = "anx1_id as RecordID,anx1_title as Title,anx1_amount as Amount,anx1_agency as SponsoringAgency,anx1_coordinator as ProjectCoordinators,anx1_status as ProjectStatus,pst_name as ProjectStatusName,anx1_proof as Sponsored_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_sd", "Y", "Y");
                break;
            case "partb_consultancy":
                $Select = "anx1_id as RecordID,anx1_title as Title,anx1_amount as Amount,anx1_client as ClientOrganization,anx1_coordinator as ProjectCoordinators,anx1_status as ProjectStatus,pst_name as ProjectStatusName,anx1_proof as Consultancy_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_cs", "Y", "Y");
                break;
            case "partb_researchguidance":
                $Select = "anx1_id as RecordID,anx1_student_name as StudentName,anx1_thesis_topic as ThesisTopic,anx1_area as Area,anx1_year as YearofResearch,anx1_type as Level";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => "Y");
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_rg", "Y", "Y");
                break;
            case "partc_leadership":
                $Select = "ptc_iso_tc_n_he_t as ISO,ptc_cul_lit_alumi as ALUMNI,ptc_nba_aicte_nptel_spoc as NPTEL,ptc_dplc_crc as PLACEMENT,ptc_stud_cou as STUDENT,ptc_fa_other_events as OTHERS,ptc_sli_inst_ks as LECTURE,ptc_awards as AWARDS,ptc_chair_mp_govt as CHAIR";
                $Condition = array("ptc_staff_ref" => $UserRef, "ptc_aca_year" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ptc_o");
                break;
            case "partc_leadership_hod_report":
                $Select = "ptc_iso_tc_n_he_t as ISO,ptc_cul_lit_alumi as ALUMNI,ptc_nba_aicte_nptel_spoc as NPTEL,ptc_dplc_crc as PLACEMENT,ptc_stud_cou as STUDENT,ptc_fa_other_events as OTHERS,ptc_sli_inst_ks as LECTURE,ptc_awards as AWARDS,ptc_chair_mp_govt as CHAIR";
                $Condition = array("ptc_staff_ref" => $UserRef, "ptc_aca_year" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ptc_o");
                break;
            case "partc_leadership_top":
                $Select = "ptc_vp_ac_po_hod as VP,ptc_gd_fyi as GD,ptc_cd_sd as CD,ptc_sl_ks as LECTURE,ptc_awads as AWARDS,ptc_c_mem_gov as CHAIR";
                $Condition = array("ptc_staff_ref" => $UserRef, "ptc_aca_year" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ptc_t");
                break;
            case "partc_leadership_top_hod_report":
                $Select = "ptc_vp_ac_po_hod as VP,ptc_gd_fyi as GD,ptc_cd_sd as CD,ptc_sl_ks as LECTURE,ptc_awads as AWARDS,ptc_c_mem_gov as CHAIR";
                $Condition = array("ptc_staff_ref" => $UserRef, "ptc_aca_year" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ptc_t");
                break;
            case "partb_patent":
                $Select = "anx1_id as RecordID,anx1_title as PatentName,pat_id as PatentType,anx1_proof as Patent_Proof,approvalstatus as ApprovalStatus";
                if ($Report == "Y"):
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
                else:
                    $Condition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                endif;
                $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_pat", "Y", "Y");
                break;
            case "partc_institutional":
                $PartCSelect = "ptc_iso_tc_n_he_t as ISO,ptc_cul_lit_alumi as ALUMNI,ptc_nba_aicte_nptel_spoc as NPTEL,ptc_dplc_crc as PLACEMENT,ptc_stud_cou as STUDENT,ptc_fa_other_events as OTHERS,ptc_sli_inst_ks as LECTURE,ptc_awards as AWARDS,ptc_chair_mp_govt as CHAIR";
                $PartcCondition = array("ptc_staff_ref" => $UserRef, "ptc_aca_year" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($PartcCondition, $PartCSelect, "ptc_o"); //Professional data
                break;
            case "partd_hod_assessment":
                $PartDSelect = "anx1_general as General,anx1_commitment as Commitment,anx1_technical as Technical,anx1_teaching as Teaching,anx1_mentoring as Mentoring,anx1_punctuality as Punctuality,anx1_academic as Academic,anx1_regularity as Regularity,anx1_communication as Communication,anx1_placement as Placement,anx1_discipline as Discipline,anx1_teamWork as TeamWork,anx1_comply as Comply,anx1_situation as Situation,anx1_organizing as Organizing";
                $PartDCondition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($PartDCondition, $PartDSelect, "anx1_hod"); //Professional data
                break;
            case "partd_hod_assessment_report":
                $PartDSelect = "anx1_general as General,anx1_commitment as Commitment,anx1_technical as Technical,anx1_teaching as Teaching,anx1_mentoring as Mentoring,anx1_punctuality as Punctuality,anx1_academic as Academic,anx1_regularity as Regularity,anx1_communication as Communication,anx1_placement as Placement,anx1_discipline as Discipline,anx1_teamWork as TeamWork,anx1_comply as Comply,anx1_situation as Situation,anx1_organizing as Organizing";
                $PartDCondition = array("anx1_staff_ref" => $UserRef, "anx1_acayear" => $AcademicYear);
                $Data = $this->Adminmodel->CSearch($PartDCondition, $PartDSelect, "anx1_hod"); //Professional data
                break;
            case "messages":
                $MessageSelect = "msg_id as messageID, msg_title as MessageTitle, msg_details as MessageBody, msg_display as MessageShow";
                $MessageCondition = array("msg_aca_year" => $_SESSION['AcademicYear']);
                $Data = $this->Adminmodel->CSearch($MessageCondition, $MessageSelect, "msg", "Y"); //Professional data
                break;
            case "academic":
                $AcademicSelect = "aca_id as academicID, aca_name as AcademicName, aca_display as AcademicShow";
                $AcademicCondition = array();
                $Data = $this->Adminmodel->CSearch($AcademicCondition, $AcademicSelect, "aca", "Y"); //Professional data
                break;
        }
        return $Data;
    }

    public function form_check_validation($formname) {
        switch (strtolower($formname)) {
            case "generalinformation":
                $rules = array(
                    array('field' => 'fullname', 'label' => 'Full Name ', 'rules' => 'required'),
                    array('field' => 'qualification', 'label' => 'Qualification ', 'rules' => 'trim|required'),
                    array('field' => 'department', 'label' => 'Department ', 'rules' => 'trim|required'),
                    array('field' => 'designation', 'label' => 'Designation', 'rules' => 'trim|required'),
                    array('field' => 'dateofbirth', 'label' => 'Date of Birth', 'rules' => 'trim|required'),
                    array('field' => 'dateatrmk', 'label' => 'Date at RMK', 'rules' => 'trim|required'),
                    array('field' => 'rmkexp', 'label' => 'RMK Experience', 'rules' => 'trim|required'),
                    array('field' => 'otherexp', 'label' => 'Other Experience', 'rules' => 'trim|required'),
                    array('field' => 'industryexp', 'label' => 'Industry Experience', 'rules' => 'trim|required'),
                );
                break;
            case "parta_academic":
                $rules = array(
                    array('field' => 'semester', 'label' => 'Semester ', 'rules' => 'trim|required|is_natural_no_zero'),
                    array('field' => 'subjectname', 'label' => 'Subject Name ', 'rules' => 'trim|required'),
                    array('field' => 'test1a', 'label' => 'Test 1 Appeared ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'test1p', 'label' => 'Test 1 Passed ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'test2a', 'label' => 'Test 2 Appeared ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'test2p', 'label' => 'Test 2 Passed ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'modela', 'label' => 'Model Appeared ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'modelp', 'label' => 'Model Passed ', 'rules' => 'trim|required|less_than_equal_to[100]|greater_than_equal_to[1]'),
                    array('field' => 'univp', 'label' => 'University Pass % ', 'rules' => 'trim|required'),
                    array('field' => 'feedp', 'label' => 'Feedback % ', 'rules' => 'trim|required'),
                );
                break;
            case "parta_fdp":
                $rules = array(
                    array('field' => 'programname', 'label' => 'Program Name ', 'rules' => 'trim|required'),
                    array('field' => 'place', 'label' => 'Place ', 'rules' => 'trim|required'),
                    array('field' => 'duration', 'label' => 'Duration ', 'rules' => 'trim|required|is_natural_no_zero'),
                    array('field' => 'sponsoringagency', 'label' => 'Sponsoring Agency', 'rules' => 'trim|required'),
                    array('field' => 'proof', 'label' => 'File Proof', 'rules' => 'callback_file_check'),
                );
                break;
            case "parta_membership":
                $rules = array(
                    array('field' => 'membershipname', 'label' => 'Program Name ', 'rules' => 'trim|required'),
                    array('field' => 'membershiptype', 'label' => 'Place ', 'rules' => 'trim|required|is_natural_no_zero'),
                );
                break;
            case "partb_research":
                $rules = array(
                    array('field' => 'papertitle', 'label' => 'Paper Title ', 'rules' => 'trim|required'),
                    array('field' => 'journalname', 'label' => 'Journal Name ', 'rules' => 'trim|required'),
                    array('field' => 'yearpublished', 'label' => 'Year Published ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[2016]|greater_than_equal_to[2015]'),
                    array('field' => 'impactfactor', 'label' => 'Impact Factor ', 'rules' => 'trim|required'),
                );
                break;
            case "partb_paper":
                $rules = array(
                    array('field' => 'papertitle', 'label' => 'Paper Title ', 'rules' => 'trim|required'),
                    array('field' => 'conferencetitle', 'label' => 'Program Name ', 'rules' => 'trim|required'),
                    array('field' => 'eventlevel', 'label' => 'Place ', 'rules' => 'trim|required|is_natural_no_zero'),
                );
                break;
            case "partb_conference":
                $rules = array(
                    array('field' => 'sponsoring', 'label' => 'Paper Title ', 'rules' => 'trim|required'),
                    array('field' => 'conferencetitle', 'label' => 'Program Name ', 'rules' => 'trim|required'),
                    array('field' => 'eventlevel', 'label' => 'Place ', 'rules' => 'trim|required|is_natural_no_zero'),
                    array('field' => 'yearparticipation', 'label' => 'Year Published ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[2016]|greater_than_equal_to[2015]'),
                );
                break;
            case "partb_patent":
                $rules = array(
                    array('field' => 'patentname', 'label' => 'Patent Name ', 'rules' => 'trim|required'),
                    array('field' => 'patenttype', 'label' => 'Patent Type ', 'rules' => 'trim|required'),
                );
                break;
            case "partb_books":
                $rules = array(
                    array('field' => 'bookname', 'label' => 'Book Name ', 'rules' => 'trim|required'),
                    array('field' => 'authorname', 'label' => 'Author Name ', 'rules' => 'trim|required'),
                    array('field' => 'area', 'label' => 'Area ', 'rules' => 'trim|required'),
                    array('field' => 'publishername', 'label' => 'Publisher Name ', 'rules' => 'trim|required'),
                    array('field' => 'yearpublishing', 'label' => 'Year Publishing ', 'rules' => 'trim|required'),
                    array('field' => 'booktype', 'label' => 'Year Publishing ', 'rules' => 'trim|required'),
                );
                break;
            case "partb_sponsored":
                $rules = array(
                    array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                    array('field' => 'amount', 'label' => 'Amount ', 'rules' => 'trim|required|is_natural_no_zero'),
                    array('field' => 'sponsoringagency', 'label' => 'Sponsoring Agency ', 'rules' => 'trim|required'),
                    array('field' => 'projectcoordinators', 'label' => 'Project Coordinators ', 'rules' => 'trim|required'),
                    array('field' => 'projectstatus', 'label' => 'Status ', 'rules' => 'trim|required'),
                );
                break;
            case "partb_consultancy":
                $rules = array(
                    array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                    array('field' => 'amount', 'label' => 'Amount ', 'rules' => 'trim|required|is_natural_no_zero'),
                    array('field' => 'clientorganization', 'label' => 'Client Organization ', 'rules' => 'trim|required'),
                    array('field' => 'projectcoordinators', 'label' => 'Project Coordinators ', 'rules' => 'trim|required'),
                    array('field' => 'projectstatus', 'label' => 'Status ', 'rules' => 'trim|required'),
                );
                break;
            case "partb_researchguidance":
                $rules = array(
                    array('field' => 'studentname', 'label' => 'Student Name', 'rules' => 'trim|required'),
                    array('field' => 'thesistopic', 'label' => 'Thesis Topic ', 'rules' => 'trim|required'),
                    array('field' => 'area', 'label' => 'Area of Specilization ', 'rules' => 'trim|required'),
                    array('field' => 'level', 'label' => 'Level ', 'rules' => 'trim|required'),
                    array('field' => 'yearofresearch', 'label' => 'Year of Research ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[2016]|greater_than_equal_to[2015]'),
                );
                break;
            case "partc_leadership":
                $rules = array(
                    array('field' => 'iso', 'label' => 'Program Name ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'alumni', 'label' => 'Alumini ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'nptel', 'label' => 'NPTEL ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'placement', 'label' => 'Placement ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'student', 'label' => 'Student ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'other', 'label' => 'Other ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[20]|greater_than_equal_to[1]'),
                    array('field' => 'lecture', 'label' => 'Lecture ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'awards', 'label' => 'Awards ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'chair', 'label' => 'Chair ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                );
                break;
            case "partc_topleadership":
                $rules = array(
                    array('field' => 'vp', 'label' => 'Vice Principal ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[20]|greater_than_equal_to[1]'),
                    array('field' => 'gd', 'label' => 'Govt. Bodies ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[15]|greater_than_equal_to[1]'),
                    array('field' => 'cd', 'label' => 'CD ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[15]|greater_than_equal_to[1]'),
                    array('field' => 'lecture', 'label' => 'Lecture ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[20]|greater_than_equal_to[1]'),
                    array('field' => 'awards', 'label' => 'Awards ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[15]|greater_than_equal_to[1]'),
                    array('field' => 'chair', 'label' => 'Chair ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[15]|greater_than_equal_to[1]'),
                );
                break;
            case "partd_hod":
                $rules = array(
                    array('field' => 'facultyname', 'label' => 'Faculty Name ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                    array('field' => 'general', 'label' => 'General ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'commitment', 'label' => 'Commitment ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'technical', 'label' => 'Technical ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'teaching', 'label' => 'Teaching ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'mentoring', 'label' => 'Mentoring ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[10]|greater_than_equal_to[1]'),
                    array('field' => 'punctuality', 'label' => 'Punctuality ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'academic', 'label' => 'Academic ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'regularity', 'label' => 'Regularity ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'communication', 'label' => 'Communication ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'placement', 'label' => 'Placement ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'discipline', 'label' => 'Discipline ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'teamWork', 'label' => 'Team Work ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'comply', 'label' => 'Comply ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'situation', 'label' => 'Situation ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]'),
                    array('field' => 'organizing', 'label' => 'Organizing ', 'rules' => 'trim|required|numeric|is_natural_no_zero|less_than_equal_to[5]|greater_than_equal_to[1]')
                );
                break;
            case "password_reset":
                $rules = array(
                    array('field' => 'departmentid', 'label' => 'Department ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                    array('field' => 'facultyid', 'label' => 'Faculty ', 'rules' => 'trim|required|numeric|is_natural_no_zero')
                );
                break;
            case "faculty_designation":
                $rules = array(
                    array('field' => 'departmentid', 'label' => 'Department ID ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                    array('field' => 'facultyid', 'label' => 'Faculty ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                    array('field' => 'designationid', 'label' => 'Designation ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                );
                break;
            case "faculty_department":
                $rules = array(
                    array('field' => 'departmentid', 'label' => 'Department ID ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                    array('field' => 'facultyid', 'label' => 'Faculty ', 'rules' => 'trim|required|numeric|is_natural_no_zero'),
                );
                break;
            case "message_operations":
                $rules = array(
                    array('field' => 'messagetitle', 'label' => 'Message ', 'rules' => 'trim|required'),
                    array('field' => 'messageshow', 'label' => 'Title ', 'rules' => 'trim|required'),
                    array('field' => 'messagebody', 'label' => 'Title ', 'rules' => 'trim|required')
                );
                break;
            case "academic_operations":
                $rules = array(
                    array('field' => 'academicyear', 'label' => 'Message ', 'rules' => 'trim|required'),
                    array('field' => 'academicshow', 'label' => 'Title ', 'rules' => 'trim|required')
                );
                break;
            case "faculty_ticket":
                $rules = array(
                    array('field' => 'tickettile', 'label' => 'Message ', 'rules' => 'trim|required'),
                    array('field' => 'message', 'label' => 'Title ', 'rules' => 'trim|required'),
                    array('field' => 'priority', 'label' => 'Title ', 'rules' => 'trim|required|numeric|is_natural_no_zero')
                );
                break;
            case "passwordreset":
                $rules = array(
                    array('field' => 'password', 'label' => 'Password ', 'rules' => 'required'),
                    array('field' => 'confirmpassword', 'label' => 'Confirm Password ', 'rules' => 'required|matches[password]')
                );
                break;
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE):
            return FALSE;
        else :
            return TRUE;
        endif;
    }

    public function PaperPresentedReputedJournalScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as PaperPresentedI";
        $ConditionI = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "jot_short_name" => "I", "approvalstatus" => 1);
        $DataI = $this->Adminmodel->CSearch($ConditionI, $Select, "ax_rs", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $DataI['PaperPresentedI'] * $this->config->item("paperpublicationinAnnexureIpoint");
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "jot_short_name" => "II", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_rs", "", "Y", "", "", "", "", ""); //Research Publications data
        $result1 = $Data['PaperPresentedI'] * $this->config->item("paperpublicationinAnnexureIIpoint");
        return (($result + $result1) > $this->config->item("paperpublicationinmax")) ? $this->config->item("paperpublicationinmax") : $result;
    }

    public function PaperPresentedOtherJournalScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as PaperPresented";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "jot_short_name" => "O", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_rs", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['PaperPresented'] * $this->config->item("paperpresented");
        return ($result > $this->config->item("paperpresentedmax")) ? $this->config->item("paperpresentedmax") : $result;
    }

    public function BooksPublishedReputedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as BooksPublishedReputed";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "bty_short_name" => "R", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_bk", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['BooksPublishedReputed'] * $this->config->item("bookspublishedreputedpoint");
        return ($result > $this->config->item("bookspublishedreputedmax")) ? $this->config->item("bookspublishedreputedmax") : $result;
    }

    public function BooksPublishedOtherScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as BooksOtherReputed";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "bty_short_name" => "O", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_bk", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['BooksOtherReputed'] * $this->config->item("bookspublishedotherpoint");
        return ($result > $this->config->item("bookspublishedothermax")) ? $this->config->item("bookspublishedothermax") : $result;
    }

    public function PaperPresentedConferenceScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ConferencePresented";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_pp", "", "", "", "", "", "", ""); //Research Publications data
        $result = $Data['ConferencePresented'] * $this->config->item("paperpresentedpoint");
        return ($result > $this->config->item("paperpresentedmax")) ? $this->config->item("paperpresentedmax") : $result;
    }

    public function ConferenceOrganizedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ConferenceOrganized";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_cf", "", "", "", "", "", "", ""); //Research Publications data
        $result = $Data['ConferencePresented'] * $this->config->item("paperpresentedpoint");
        return ($result > $this->config->item("paperpresentedmax")) ? $this->config->item("paperpresentedmax") : $result;
    }

    public function SponsoredProjectsAppliedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as SponsoredProjects";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "pst_name" => "ONGOING", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_sd", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['SponsoredProjects'] * $this->config->item("sponsoredprojectappliedpoint");
        return ($result > $this->config->item("sponsoredprojectappliedmax")) ? $this->config->item("sponsoredprojectappliedmax") : $result;
    }

    public function SponsoredProjectGrantedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as SponsoredProjects";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "pst_name" => "COMPLETED", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_sd", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['SponsoredProjects'] * $this->config->item("sponsoredprojectgrantedpoint");
        return ($result > $this->config->item("sponsoredprojectgrantedmax")) ? $this->config->item("sponsoredprojectgrantedmax") : $result;
    }

    public function ConsultancyProjectsCompletedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ConferenceOrganized";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "pst_name" => "COMPLETED", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_cs", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['ConferenceOrganized'] * $this->config->item("consultancypoint");
        return ($result > $this->config->item("consultancymax")) ? $this->config->item("consultancymax") : $result;
    }

    public function ResearchGuidanceScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ResearchGuidance";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_rg", "", "", "", "", "", "", ""); //Research Publications data
        $result = $Data['ResearchGuidance'] * $this->config->item("phdscholarpoint");
        return ($result > $this->config->item("phdscholarpointmax")) ? $this->config->item("phdscholarpointmax") : $result;
    }

    public function PatentAppliedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as PatentApplied";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "pat_short_name" => "A", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_pat", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['PatentApplied'] * $this->config->item("patentappliedpoint");
        return ($result > $this->config->item("patentappliedmax")) ? $this->config->item("patentappliedmax") : $result;
    }

    public function PatentObatinedScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as PatentObtained";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "pat_short_name" => "C", "approvalstatus" => 1);
        $Data = $this->Adminmodel->CSearch($Condition, $Select, "ax_pat", "", "Y", "", "", "", "", ""); //Research Publications data
        $result = $Data['PatentObtained'] * $this->config->item("patentobtainedpoint");
        return ($result > $this->config->item("patentobtainedmax")) ? $this->config->item("patentobtainedmax") : $result;
    }

    public function PartAAcademicInternalTestOddScore($AcademicYear, $staffid) {
        $Select = "anx1_inte_perc as InteralPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "ODD", "approvalstatus" => 1);
        $DataODD = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Odd Semster data
        $Score = number_format(($this->AvgGroup($DataODD, "InteralPercentage") / $this->config->item("internalassessmentpoint") * $this->config->item("internalassessmentpointmax")), 2);

        return ($Score > $this->config->item("internalassessmentpointmax")) ? $this->config->item("internalassessmentpointmax") : $Score;
    }

    public function PartAAcademicInternalTestEvenScore($AcademicYear, $staffid) {
        $Select = "anx1_inte_perc as InteralPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "EVEN", "approvalstatus" => 1);
        $DataEven = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Odd Semster data
        $Score = number_format(($this->AvgGroup($DataEven, "InteralPercentage") / $this->config->item("internalassessmentpoint") * $this->config->item("internalassessmentpointmax")), 2);
        return ($Score > $this->config->item("internalassessmentpointmax")) ? $this->config->item("internalassessmentpointmax") : $Score;
    }

    public function PartAAcademicUniversityTestOddScore($AcademicYear, $staffid) {
        $Select = "anx1_univ_perc as UniversityPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "ODD", "approvalstatus" => 1);
        $DataODD = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Odd Semster data
        $Score = number_format(($this->AvgGroup($DataODD, "UniversityPercentage") / $this->config->item("universityexaminationpoint") * $this->config->item("universityexaminationpointmax")), 2);
        return ($Score > $this->config->item("universityexaminationpointmax")) ? $this->config->item("universityexaminationpointmax") : $Score;
    }

    public function PartAAcademicUniversityTestEvenScore($AcademicYear, $staffid) {
        $Select = "anx1_univ_perc as UniversityPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "EVEN", "approvalstatus" => 1);
        $DataEVEN = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Even Semster
        $Score = number_format(($this->AvgGroup($DataEVEN, "UniversityPercentage") / $this->config->item("universityexaminationpoint") * $this->config->item("universityexaminationpointmax")), 2);
        return ($Score > $this->config->item("universityexaminationpointmax")) ? $this->config->item("universityexaminationpointmax") : $Score;
    }

    public function PartAAcademicFeedBackOddScore($AcademicYear, $staffid) {
        $Select = "anx1_fdbk_perc as FeedBackPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "ODD", "approvalstatus" => 1);
        $DataODD = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Odd Semster data
        $Score = number_format(($this->AvgGroup($DataODD, "FeedBackPercentage") / $this->config->item("feedbackpoint") * $this->config->item("feedbackpointmax")), 2);
        return ($Score > $this->config->item("feedbackpointmax")) ? $this->config->item("feedbackpointmax") : $Score;
    }

    public function PartAAcademicFeedBackEvenScore($AcademicYear, $staffid) {
        $Select = "anx1_fdbk_perc as FeedBackPercentage";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "sem_name" => "EVEN", "approvalstatus" => 1);
        $DataEVEN = $this->Adminmodel->CSearch($Condition, $Select, "ax_su", "Y", "Y", "", "", "", "", ""); //Even Semster
        $Score = number_format(($this->AvgGroup($DataEVEN, "FeedBackPercentage") / $this->config->item("feedbackpoint") * $this->config->item("feedbackpointmax")), 2);
        return ($Score > $this->config->item("feedbackpointmax")) ? $this->config->item("feedbackpointmax") : $Score;
    }

    public function PartAFDPScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ProgramName";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
        $DataFDP = $this->Adminmodel->CSearch($Condition, $Select, "ax_fdp", "Y", "", "", "", "", "", ""); //FDP data
        $Score = $DataFDP[0]['ProgramName'] * $this->config->item("refreshercoursepoint");
        return ($Score > $this->config->item("refreshercoursepointmax")) ? $this->config->item("refreshercoursepointmax") : $Score;
    }

    public function PartAMembershipScore($AcademicYear, $staffid) {
        $Select = "count(anx1_id) as ProfessionaSocietyName";
        $Condition = array("anx1_staff_ref" => $staffid, "anx1_acayear" => $AcademicYear, "approvalstatus" => 1);
        $DataProfessional = $this->Adminmodel->CSearch($Condition, $Select, "ax_ms", "Y", "", "", "", "", "", ""); //Professional data
        $Score = $DataProfessional[0]['ProfessionaSocietyName'] * $this->config->item("membershippoint");
        return ($Score > $this->config->item("membershippointmax")) ? $this->config->item("membershippointmax") : $Score;
    }

    public function PartCScore($AcademicYear, $staffid) {
        $PartCSelect = "sum(ptc_iso_tc_n_he_t+ptc_cul_lit_alumi+ptc_nba_aicte_nptel_spoc+ptc_dplc_crc+ptc_stud_cou+ptc_fa_other_events+ptc_sli_inst_ks+ptc_awards+ptc_chair_mp_govt) as PartC";
        $PartcCondition = array("ptc_staff_ref" => $staffid, "ptc_aca_year" => $AcademicYear);
        $DataC = $this->Adminmodel->CSearch($PartcCondition, $PartCSelect, "ptc_o"); //Professional data
        return ($DataC['PartC'] == "") ? "0" : $DataC['PartC'];
    }

    public function PartCTopScore($AcademicYear, $staffid) {
        $PartCSelect = "sum(ptc_iso_tc_n_he_t+ptc_cul_lit_alumi+ptc_nba_aicte_nptel_spoc+ptc_dplc_crc+ptc_stud_cou+ptc_fa_other_events+ptc_sli_inst_ks+ptc_awards+ptc_chair_mp_govt) as PartC";
        $PartcCondition = array("ptc_staff_ref" => $staffid, "ptc_aca_year" => $AcademicYear);
        $DataC = $this->Adminmodel->CSearch($PartcCondition, $PartCSelect, "ptc_o"); //Professional data
        return ($DataC['PartC'] == "") ? "0" : $DataC['PartC'];
    }

    /* PDF REPORT SECTION STARTS HERE */

    public function pdfreport($option) {
        switch (strtolower($option)):
            case "general_information":
                $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                $Data = $this->fetch_Data("generalinformation");
                $pdfPortarit->WriteHTML($this->load->view("pdfreport/general_information", get_defined_vars(), true));
                $pdfPortarit->Output("General_Information.pdf", 'I');
                break;
            case "parta_academic_overall":
                $Information = array("InteralMarkODD" => $this->PartAAcademicInternalTestOddScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "UniversityMarkODD" => $this->PartAAcademicUniversityTestOddScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "FeedBackMarkODD" => $this->PartAAcademicFeedBackOddScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "InteralMarkEVEN" => $this->PartAAcademicInternalTestEvenScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "UniversityMarkEVEN" => $this->PartAAcademicUniversityTestEvenScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "FeedBackMarkEVEN" => $this->PartAAcademicFeedBackEvenScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "FDP" => $this->PartAFDPScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "ProfessionalSoc" => $this->PartAMembershipScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                );
                $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                $pdfPortarit->WriteHTML($this->load->view("pdfreport/parta_academic_overall", get_defined_vars(), true));
                $pdfPortarit->Output("PartA_Overall.pdf", 'I');
                break;
            case "parta_academic_detailed":
                $pdfPortarit = new mPDF('c', 'A4-L', 10, '', 10, 10, 10, 10, 6, 3);
                $AcademicODD = $this->fetch_Data("parta_academic_odd", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $AcademicEven = $this->fetch_Data("parta_academic_even", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $FDP = $this->fetch_Data("parta_fdp", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Membership = $this->fetch_Data("parta_membership", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Research = $this->fetch_Data("partb_research", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $PaperPresented = $this->fetch_Data("partb_paper", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Conference = $this->fetch_Data("partb_conference", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Books = $this->fetch_Data("partb_books", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Sponsored = $this->fetch_Data("partb_sponsored", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $Consultancy = $this->fetch_Data("partb_consultancy", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");
                $ResearchGuidance = $this->fetch_Data("partb_researchguidance", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $Patent = $this->fetch_Data("partb_patent", $_SESSION['UserId'], $_SESSION['AcademicYear'], "Y");

                //pdf image fetching


                $pdfPortarit->WriteHTML($this->load->view("pdfreport/parta_academic_detailed", get_defined_vars(), true));
                $pdfPortarit->Output("PartA_Detailed.pdf", 'I');
                break;
            case "partb_research_overall":
                $PartBInformation = array(
                    "PatentApplied" => $this->PatentAppliedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "PatentObtained" => $this->PatentObatinedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "PublicationInternational" => $this->PaperPresentedReputedJournalScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "PublicationOther" => $this->PaperPresentedOtherJournalScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "PapersPresentedConference" => $this->PaperPresentedConferenceScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "ConferenceOrganizedScore" => $this->ConferenceOrganizedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "BooksPublishedReputed" => $this->BooksPublishedReputedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "BooksPublishedOther" => $this->BooksPublishedOtherScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "SponsoredProjectsApplied" => $this->SponsoredProjectsAppliedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "SponsoredProjectsGranted" => $this->SponsoredProjectGrantedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "ConsultancyProjectsCompleted" => $this->ConsultancyProjectsCompletedScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    "ResearchGuidance" => $this->ResearchGuidanceScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                );
                $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                $pdfPortarit->WriteHTML($this->load->view("pdfreport/partb_research_overall", get_defined_vars(), true));
               $pdfPortarit->Output("PartB_Research_Overall.pdf", 'I');
                break;
            case "partc_institutional":
                $DataC = $this->fetch_Data("partc_institutional", $_SESSION['UserId'], $_SESSION['AcademicYear']);
                $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                if (array_sum($DataC) === 0):
                    $pdfPortarit->WriteHTML($this->load->view("pdfreport/nodata", get_defined_vars(), true));
                else:
                    $pdfPortarit->WriteHTML($this->load->view("pdfreport/partc_institutional_overall", get_defined_vars(), true));
                endif;
                $pdfPortarit->Output("PartC_Institutional_Overall.pdf", 'I');
                break;
            case "partc_institutional_top":
                $Data = $this->fetch_Data("partc_leadership_top");
                $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                if (array_sum($Data) === 0):
                    $pdfPortarit->WriteHTML($this->load->view("pdfreport/nodata", get_defined_vars(), true));
                else:
                    $pdfPortarit->WriteHTML($this->load->view("pdfreport/partc_institutional_top_overall", get_defined_vars(), true));
                endif;
                $pdfPortarit->Output("PartC_Institutional_Top_Overall.pdf", 'I');
                break;
            case "partd_hod_assessment":
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "individual_report_faculty":
                $this->render(strtolower($option), get_defined_vars());
                break;
            case "individual_report_faculty_pdf":
                $PostData = $this->input->post();
                $pdfPortarit = new mPDF('c', 'A4-L', 10, '', 10, 10, 10, 10, 6, 3);
                $AcademicODD = $this->fetch_Data("parta_academic_odd", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $AcademicEven = $this->fetch_Data("parta_academic_even", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $FDP = $this->fetch_Data("parta_fdp", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Membership = $this->fetch_Data("parta_membership", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Research = $this->fetch_Data("partb_research", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $PaperPresented = $this->fetch_Data("partb_paper", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Conference = $this->fetch_Data("partb_conference", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Books = $this->fetch_Data("partb_books", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Sponsored = $this->fetch_Data("partb_sponsored", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $Consultancy = $this->fetch_Data("partb_consultancy", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $ResearchGuidance = $this->fetch_Data("partb_researchguidance", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                $pdfPortarit->WriteHTML($this->load->view("pdfreport/parta_academic_detailed", get_defined_vars(), true));
                $pdfPortarit->Output("Individual_Faculty_Detailed_Report.pdf", 'I');
                break;
            case "partd_hod_assessment_report":
                $PostData = $this->input->post();
                $DataD = $this->fetch_Data("partd_hod_assessment", $this->encrypt->decode($PostData['facultyname']), $this->encrypt->decode($PostData['academicyear']));
                if ($PostData === null):
                    $this->render(strtolower("partd_hod_assessment"), get_defined_vars());
                else:
                    $pdfPortarit = new mPDF('c', 'A4', 10, '', 10, 10, 15, 10, 6, 3);
                    $pdfPortarit->WriteHTML($this->load->view("pdfreport/partd_hod_assessment_report", get_defined_vars(), true));
                    $pdfPortarit->Output("PartD_HOD_Assessment.pdf", 'I');
                endif;
                break;
            case "conslidated_all_staff":
                $Facultys = $this->fetch_allfaculty_by_dept($_SESSION['DepartmentID']);
                foreach ($Facultys as $Faculty):
                    $Information = array("InteralMarkODD" => $this->PartAAcademicInternalTestOddScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "UniversityMarkODD" => $this->PartAAcademicUniversityTestOddScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "FeedBackMarkODD" => $this->PartAAcademicFeedBackOddScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "InteralMarkEVEN" => $this->PartAAcademicInternalTestEvenScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "UniversityMarkEVEN" => $this->PartAAcademicUniversityTestEvenScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "FeedBackMarkEVEN" => $this->PartAAcademicFeedBackEvenScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "FDP" => $this->PartAFDPScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "ProfessionalSoc" => $this->PartAMembershipScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                    );

                    $PartBInformation = array(
                        "PatentApplied" => $this->PatentAppliedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "PatentObtained" => $this->PatentObatinedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "PublicationInternational" => $this->PaperPresentedReputedJournalScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "PublicationOther" => $this->PaperPresentedOtherJournalScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "PapersPresentedConference" => $this->PaperPresentedConferenceScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "ConferenceOrganizedScore" => $this->ConferenceOrganizedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "BooksPublishedReputed" => $this->BooksPublishedReputedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "BooksPublishedOther" => $this->BooksPublishedOtherScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "SponsoredProjectsApplied" => $this->SponsoredProjectsAppliedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "SponsoredProjectsGranted" => $this->SponsoredProjectGrantedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "ConsultancyProjectsCompleted" => $this->ConsultancyProjectsCompletedScore($_SESSION['AcademicYear'], $Faculty['FacultyID']),
                        "ResearchGuidance" => $this->ResearchGuidanceScore($_SESSION['AcademicYear'], $_SESSION['UserId']),
                    );
                    if ($Faculty['Role'] == "HOD" || $Faculty['Role'] == "PRINCIPAL"):
                        $PartC = $this->fetch_Data("partc_leadership_top_hod_report", $Faculty['FacultyID'], $_SESSION['AcademicYear']);
                    else:
                        $PartC = $this->fetch_Data("partc_leadership_hod_report", $Faculty['FacultyID'], $_SESSION['AcademicYear']);
                    endif;
                    $PartD = $this->fetch_Data("partd_hod_assessment_report", $Faculty['FacultyID'], $_SESSION['AcademicYear']);

                    $Conslidated[] = array("FacultyName" => $Faculty['FacultyName'], "FacultyRole" => $Faculty['Role'], "FacultyDesg" => $Faculty['Designation'], "PartA" => $Information, "PartB" => $PartBInformation, "PartC" => $PartC, "PartD" => $PartD);
                endforeach;
                $pdfPortarit = new mPDF('c', 'A4-L', 10, '', 8, 8, 10, 10, 3, 3);
                $pdfPortarit->WriteHTML($this->load->view("pdfreport/conslidated_all_staff", get_defined_vars(), true));
                $pdfPortarit->Output("Conslidated_All_Faculty.pdf", 'I');
                break;
            default:
                redirect('/' . strtolower($this->router->fetch_class()) . '/index');
                break;
        endswitch;
    }

    /* PDF REPORT SECTION ENDS HERE


      /* COMMON FUNCTION STARTS HERE */

    public function GeneralInformationSave($option) {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("generalinformation")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("stp_id" => $_SESSION['UserId']);
                        $DBData = array(
                            "stp_name" => $postData['fullname'],
                            "stp_dept" => $postData['department'],
                            "stp_desg" => $postData['designation'],
                            "stp_qual" => $postData['qualification'],
                            "stp_dob" => $postData['dateofbirth'],
                            "stp_doj" => $postData['dateatrmk']
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "stp");
                        if (!empty($Response)):
                            $ConditionEXP = array("exp_id" => $postData['expid']);
                            $DBDataEXP = array(
                                "exp_staff_ref" => $_SESSION['UserId'],
                                "exp_aca_ref" => $_SESSION['AcademicYear'],
                                "exp_rmk" => $postData['rmkexp'],
                                "exp_other" => $postData['otherexp'],
                                "exp_industry" => $postData['industryexp'],
                                "exp_total" => $postData['rmkexp'] + $postData['otherexp'] + $postData['industryexp']
                            );
                            $ResponseEXP = $this->Adminmodel->AllInsert($ConditionEXP, $DBDataEXP, "", "exp");
                            if (!empty($ResponseEXP)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/generalinformation');
                break;
            default:
                $this->render("generalinformation", get_defined_vars());
                break;
        endswitch;
    }

    public function PartCLeaderShipOthersSave($option) {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partc_leadership")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("ptc_staff_ref" => $_SESSION['UserId'], "ptc_aca_year" => $_SESSION['AcademicYear']);
                        $DBData = array(
                            "ptc_aca_year" => $_SESSION['AcademicYear'],
                            "ptc_staff_ref" => $_SESSION['UserId'],
                            "ptc_iso_tc_n_he_t" => $postData['iso'],
                            "ptc_cul_lit_alumi" => $postData['alumni'],
                            "ptc_nba_aicte_nptel_spoc" => $postData['nptel'],
                            "ptc_dplc_crc" => $postData['placement'],
                            "ptc_stud_cou" => $postData['student'],
                            "ptc_fa_other_events" => $postData['other'],
                            "ptc_sli_inst_ks" => $postData['lecture'],
                            "ptc_awards" => $postData['awards'],
                            "ptc_chair_mp_govt" => $postData['chair'],
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ptc_o");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partc_leadership');
                break;
            default:
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partc_leadership');
                break;
        endswitch;
    }

    public function PartAAcademicSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("parta_academic") && $postData['test1p'] <= $postData['test1a'] && $postData['test2p'] <= $postData['test2a'] && $postData['modelp'] <= $postData['modela']):
                    if ($postData['question'] === $postData['answer']):
                        $totalApp = $postData['test1a'] + $postData['test2a'] + $postData['modela'];
                        $totalPas = $postData['test1p'] + $postData['test2p'] + $postData['modelp'];
                        $Condition = array("anx1_id" => (!empty($key)) ? $this->encrypt->decode($key) : '');
                        $DBData = array(
                            "anx1_acayear" => $_SESSION['AcademicYear'],
                            "anx1_staff_ref" => $_SESSION['UserId'],
                            "anx1_sem" => $postData['semester'],
                            "anx1_subname" => strtoupper($postData['subjectname']),
                            "anx1_test1_app" => $postData['test1a'],
                            "anx1_test1_pas" => $postData['test1p'],
                            "anx1_test2_app" => $postData['test2a'],
                            "anx1_test2_pas" => $postData['test2p'],
                            "anx1_model_app" => $postData['modela'],
                            "anx1_model_pas" => $postData['modelp'],
                            "anx1_inte_perc" => number_format(($totalPas / $totalApp) * 100, 2),
                            "anx1_univ_perc" => $postData['univp'],
                            "anx1_fdbk_perc" => $postData['feedp']
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_su");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/parta_academic');
                break;
            default:
                $this->render("parta_academic", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $Response = $this->Adminmodel->DropData($Condition, "ax_su");
                $data = array();
                if (!empty($Response)):
                    $data['success'] = true;
                    $data['message'] = "Record Deleted Successfully";
                else:
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                endif;
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartAFDPSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("parta_fdp")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_fdp", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_FDP_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("fdp", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_program_name" => strtoupper($postData['programname']),
                                "anx1_place" => strtoupper($postData['place']),
                                "anx1_duration" => $postData['duration'],
                                "anx1_spon_agency" => strtoupper($postData['sponsoringagency']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_fdp");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/parta_fdp');
                break;
            default:
                $this->render("parta_fdp", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_fdp", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/fdp/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_fdp");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartAMemberShipSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("parta_membership")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_ms", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_FDP_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("membership", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_membership_name" => strtoupper($postData['membershipname']),
                                "anx1_membership_type" => strtoupper($postData['membershiptype']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_ms");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/parta_membership');
                break;
            default:
                $this->render("parta_membership", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_ms", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/membership/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_ms");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBResearchSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_research")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_rs", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_RESEARCH_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("researchpublications", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_paper_title" => strtoupper($postData['papertitle']),
                                "anx1_journal_name" => strtoupper($postData['journalname']),
                                "anx1_year_pub" => strtoupper($postData['yearpublished']),
                                "anx1_imapct_factor" => strtoupper($postData['impactfactor']),
                                "anx1_journal_type" => strtoupper($postData['journaltype']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_rs");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_research');
                break;
            default:
                $this->render("partb_research", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_rs", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/researchpublications/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_rs");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "File Cannot be deleted";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBPaperSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_paper")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_pp", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_PAPER_PP_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("paperpresented", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_paper_title" => strtoupper($postData['papertitle']),
                                "anx1_conf_title" => strtoupper($postData['conferencetitle']),
                                "anx1_event_ref" => strtoupper($postData['eventlevel']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_pp");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_paper');
                break;
            default:
                $this->render("partb_paper", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_pp", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/paperpresented/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_pp");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "File Cannot be deleted";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBConferenceSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_conference")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $DBData = array(
                            "anx1_acayear" => $_SESSION['AcademicYear'],
                            "anx1_staff_ref" => $_SESSION['UserId'],
                            "anx1_sponsor_agy" => strtoupper($postData['sponsoring']),
                            "anx1_conference_title" => strtoupper($postData['conferencetitle']),
                            "anx1_conference_type" => strtoupper($postData['eventlevel']),
                            "anx1_year" => strtoupper($postData['yearparticipation']),
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_cf");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_conference');
                break;
            default:
                $this->render("partb_conference", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $Response = $this->Adminmodel->DropData($Condition, "ax_cf");
                $data = array();
                if (!empty($Response)):
                    $data['success'] = true;
                    $data['message'] = "Record Deleted Successfully";
                else:
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                endif;
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBBooksSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_books")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_bk", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_BOOK_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("books", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_book_name" => strtoupper($postData['bookname']),
                                "anx1_author_name" => strtoupper($postData['authorname']),
                                "anx1_area_spec" => strtoupper($postData['area']),
                                "anx1_publisher_name" => strtoupper($postData['publishername']),
                                "anx1_year" => strtoupper($postData['yearpublishing']),
                                "anx1_book_type_ref" => strtoupper($postData['booktype']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_bk");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_books');
                break;
            default:
                $this->render("partb_books", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_bk", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/books/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_bk");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "File Cannot be deleted";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBSponsoredSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_sponsored")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_sd", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_sponsoredprojects_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("sponsoredprojects", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_title" => strtoupper($postData['title']),
                                "anx1_amount" => strtoupper($postData['amount']),
                                "anx1_agency" => strtoupper($postData['sponsoringagency']),
                                "anx1_coordinator" => strtoupper($postData['projectcoordinators']),
                                "anx1_status" => strtoupper($postData['projectstatus']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_sd");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_sponsored');
                break;
            default:
                $this->render("partb_sponsored", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_sd", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/sponsoredprojects/';
                if (is_file($urltodelete . $imagename)) {
                    unlink($urltodelete . $imagename);
                    $Response = $this->Adminmodel->DropData($Condition, "ax_bk");
                    $data = array();
                    if (!empty($Response)):
                        $data['success'] = true;
                        $data['message'] = "Record Deleted Successfully";
                    else:
                        $data['success'] = false;
                        $data['message'] = "Some thing went wrong";
                    endif;
                }
                else {
                    $data['success'] = false;
                    $data['message'] = "File Cannot be deleted";
                }
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBConsultancySave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_consultancy")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_cs", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_consultancyprojects_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("consultancyprojects", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_title" => strtoupper($postData['title']),
                                "anx1_amount" => strtoupper($postData['amount']),
                                "anx1_client" => strtoupper($postData['clientorganization']),
                                "anx1_coordinator" => strtoupper($postData['projectcoordinators']),
                                "anx1_status" => strtoupper($postData['projectstatus']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_cs");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_consultancy');
                break;
            default:
                $this->render("partb_consultancy", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_cs", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/consultancyprojects/';
                unlink($urltodelete . $imagename);
                $Response = $this->Adminmodel->DropData($Condition, "ax_cs");
                $data = array();
                if (!empty($Response)):
                    $data['success'] = true;
                    $data['message'] = "Record Deleted Successfully";
                else:
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                endif;
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBResearchGuidanceSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_researchguidance")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $DBData = array(
                            "anx1_acayear" => $_SESSION['AcademicYear'],
                            "anx1_staff_ref" => $_SESSION['UserId'],
                            "anx1_student_name" => strtoupper($postData['studentname']),
                            "anx1_thesis_topic" => strtoupper($postData['thesistopic']),
                            "anx1_area" => strtoupper($postData['area']),
                            "anx1_year" => strtoupper($postData['yearofresearch']),
                            "anx1_type" => strtoupper($postData['level']),
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_rg");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_researchguidance');
                break;
            default:
                $this->render("partb_researchguidance", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $Response = $this->Adminmodel->DropData($Condition, "ax_rg");
                $data = array();
                if (!empty($Response)):
                    $data['success'] = true;
                    $data['message'] = "Record Deleted Successfully";
                else:
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                endif;
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartBPatentSave($option, $key = "") {
        switch ($option):
            case "add":
                $postData = $this->input->post();
                if ($this->form_check_validation("partb_patent")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_id" => $this->encrypt->decode($key));
                        $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_pat", "", TRUE));
                        if ($imagename == null):
                            $filename = $_SESSION['UserName'] . "_PATENT_" . rand(10000, 9999999999) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        else:
                            $filename = $imagename;
                        endif;
                        if ($this->uploadproof("patent", $filename) == false):
                            $this->session->set_flashdata('ME_ERROR', 'File Upload Failed');
                        else:
                            $DBData = array(
                                "anx1_acayear" => $_SESSION['AcademicYear'],
                                "anx1_staff_ref" => $_SESSION['UserId'],
                                "anx1_title" => strtoupper($postData['patentname']),
                                "anx1_patent_ref" => strtoupper($postData['patenttype']),
                                "anx1_proof" => $filename
                            );
                            $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ax_pat");
                            if (!empty($Response)):
                                $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                            else:
                                $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                            endif;
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partb_patent');
                break;
            default:
                $this->render("partb_patent", get_defined_vars());
                break;
            case "delete":
                $Condition = array("anx1_id" => $this->encrypt->decode($key));
                $imagename = current($this->Adminmodel->CSearch($Condition, "anx1_proof as imagename", "ax_pat", "", TRUE));
                $urltodelete = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/patent/';
                unlink($urltodelete . $imagename);
                $Response = $this->Adminmodel->DropData($Condition, "ax_pat");
                $data = array();
                if (!empty($Response)):
                    $data['success'] = true;
                    $data['message'] = "Record Deleted Successfully";
                else:
                    $data['success'] = false;
                    $data['message'] = "Some thing went wrong";
                endif;
                echo json_encode($data);
                break;
        endswitch;
    }

    public function PartCLeaderShipTopOthersSave($option) {
        switch ($option):
            case "edit":
                $postData = $this->input->post();
                if ($this->form_check_validation("partc_topleadership")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("ptc_staff_ref" => $_SESSION['UserId'], "ptc_aca_year" => $_SESSION['AcademicYear']);
                        $DBData = array(
                            "ptc_aca_year" => $_SESSION['AcademicYear'],
                            "ptc_staff_ref" => $_SESSION['UserId'],
                            "ptc_vp_ac_po_hod" => $postData['vp'],
                            "ptc_gd_fyi" => $postData['gd'],
                            "ptc_cd_sd" => $postData['cd'],
                            "ptc_sl_ks" => $postData['lecture'],
                            "ptc_awads" => $postData['awards'],
                            "ptc_c_mem_gov" => $postData['chair'],
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "ptc_t");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partc_leadership_top');
                break;
            default:
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partc_leadership_top');
                break;
        endswitch;
    }

    public function PartDAssessmentSave($option) {
        switch ($option):
            case "edit":
                $postData = $this->input->post();
                if ($this->form_check_validation("partd_hod")):
                    if ($postData['question'] === $postData['answer']):
                        $Condition = array("anx1_staff_ref" => $postData['facultyname'], "anx1_acayear" => $_SESSION['AcademicYear']);
                        $DBData = array(
                            "anx1_acayear" => $_SESSION['AcademicYear'],
                            "anx1_staff_ref" => $postData['facultyname'],
                            "anx1_general" => $postData['general'],
                            "anx1_commitment" => $postData['commitment'],
                            "anx1_technical" => $postData['technical'],
                            "anx1_teaching" => $postData['teaching'],
                            "anx1_mentoring" => $postData['mentoring'],
                            "anx1_punctuality" => $postData['punctuality'],
                            "anx1_academic" => $postData['academic'],
                            "anx1_regularity" => $postData['regularity'],
                            "anx1_communication" => $postData['communication'],
                            "anx1_placement" => $postData['placement'],
                            "anx1_discipline" => $postData['discipline'],
                            "anx1_teamWork" => $postData['teamWork'],
                            "anx1_comply" => $postData['comply'],
                            "anx1_situation" => $postData['situation'],
                            "anx1_organizing" => $postData['organizing']
                        );
                        $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "anx1_hod");
                        if (!empty($Response)):
                            $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                        else:
                            $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                        endif;
                    else:
                        $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
                    endif;
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
                endif;
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partd_hod_assessment');
                break;
            case "get":
                $postData = $this->input->post();
                $PartDSelect = "anx1_general as General,anx1_commitment as Commitment,anx1_technical as Technical,anx1_teaching as Teaching,anx1_mentoring as Mentoring,anx1_punctuality as Punctuality,anx1_academic as Academic,anx1_regularity as Regularity,anx1_communication as Communication,anx1_placement as Placement,anx1_discipline as Discipline,anx1_teamWork as TeamWork,anx1_comply as Comply,anx1_situation as Situation,anx1_organizing as Organizing";
                $Condition = array("anx1_staff_ref" => $postData['facultyname'], "anx1_acayear" => $_SESSION['AcademicYear']);
                $Data = $this->Adminmodel->CSearch($Condition, $PartDSelect, "anx1_hod"); //Professional data
                $data = array(
                    "General" => $Data['General'],
                    "Commitment" => $Data['Commitment'],
                    "Technical" => $Data['Technical'],
                    "Teaching" => $Data['Teaching'],
                    "Mentoring" => $Data['Mentoring'],
                    "Punctuality" => $Data['Punctuality'],
                    "Academic" => $Data['Academic'],
                    "Regularity" => $Data['Regularity'],
                    "Communication" => $Data['Communication'],
                    "Placement" => $Data['Placement'],
                    "Discipline" => $Data['Discipline'],
                    "TeamWork" => $Data['TeamWork'],
                    "Comply" => $Data['Comply'],
                    "Situation" => $Data['Situation'],
                    "Organizing" => $Data['Organizing']
                );
                echo json_encode($data);
                break;
            default:
                redirect('/' . strtolower($this->router->fetch_class()) . '/assessmentforms/partd_hod_assessment');
                break;
        endswitch;
    }

    private function fetch_allfaculty_by_dept($deptid) {
        $FacultySelect = "stp_id as FacultyID,stp_name as FacultyName,role_name as Role,des_short_name as Designation,des_sort_order as SortOrder";
        $FacultyCondition = array("stp_dept" => $deptid);
        $Data = $this->Adminmodel->CSearch($FacultyCondition, $FacultySelect, "stp", "Y", "Y");
        $order = array();
        foreach ($Data as $key => $row) {
            $order[$key] = $row['SortOrder'];
        }
        array_multisort($order, SORT_ASC, $Data);
        return $Data;
    }

    /* COMMON FUNCTION ENDS HERE */

    /* Ajax Fetch for Faculy by Department Starts Here */

    public function FetchFaculty() {
        $Postdata = $this->input->post();
        $DepartmentID = $this->input->post('id', TRUE);
        $FacultySelect = "stp_id as FacultyID,stp_name as FacultyName";
        $FacultyCondition = array("stp_dept" => $DepartmentID);
        $Data = $this->Adminmodel->CSearch($FacultyCondition, $FacultySelect, "stp", "Y");
        $output = "<option value=''></option>";
        foreach ($Data as $row) {
            $output .= "<option value='" . $row['FacultyID'] . "'>" . strtoupper($row['FacultyName']) . "</option>";
        }
        echo $output;
    }

    public function uploadproof($option, $filename) {
        $config['allowed_types'] = 'jpg|jpeg';
        $config['file_name'] = $filename;
        $config['max_size'] = '1024';
        $config['encrypt_name'] = FALSE;
        $config['overwrite'] = true;
        $config['upload_path'] = './assets/upload/images/' . $_SESSION['AcademicYearFull'] . '/' . strtolower($option) . '/';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("file")):
            return false;
        else:
            return true;
        endif;
    }

    public function file_check($str) {
        $allowed_mime_type_arr = array('image/jpeg', 'image/jpg');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only jpg/jpeg file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    /* Ajax Fetch for Faculy by Department Ends Here */

    //Password reset for all 
    public function PasswordReset() {
        $postData = $this->input->post();
        if ($this->form_check_validation("passwordreset")):
            if ($postData['question'] === $postData['answer']):
                $Condition = array("stp_id" => $_SESSION['UserId']);
                $DBData = array(
                    "stp_password" => $postData['password']
                );
                $Response = $this->Adminmodel->AllInsert($Condition, $DBData, "", "stp");
                if (!empty($Response)):
                    $this->session->set_flashdata('ME_SUCCESS', 'Your information is saved');
                else:
                    $this->session->set_flashdata('ME_ERROR', 'Some thing went wrong Please try again.');
                endif;
            else:
                $this->session->set_flashdata('ME_ERROR', 'Incorrect Captcha');
            endif;
        else:
            $this->session->set_flashdata('ME_ERROR', 'Form Validation Failed');
        endif;
        $this->Logout();
    }

}
