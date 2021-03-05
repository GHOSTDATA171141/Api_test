<?php namespace App\Modules\Adminmanagement\Controllers;

use App\Modules\Adminmanagement\Repositories\AdminmanagementRepositories;

class Adminmanagement extends BaseController
{
	private $adminmanagementRepositories;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->adminmanagementRepositories = new AdminmanagementRepositories();
    }
    public function index()
    {
        return $this->adminmanagementRepositories->getAdminPage();
    }
    public function add()
    {
        return $this->adminmanagementRepositories->getAddAdminPage();
    }
    public function addadmin()
    {
        return $this->adminmanagementRepositories->getaddadmin($this->request);
    }

    public function edit($id)
    {
        return $this->adminmanagementRepositories->editAdmin($id);
    }

    public function update()
    {
        return $this->adminmanagementRepositories->update($this->request);
    }

    public function delete($id)
    {
        return $this->adminmanagementRepositories->deleteAdmin($id);
    }

    public function changepassword()
    {
        return $this->adminmanagementRepositories->getChangePassword();
    }
    public function getprovince()
    {
        return $this->adminmanagementRepositories->getProvince();
    }
    public function getamphur()
    {
        return $this->adminmanagementRepositories->getAmphur($this->request);
    }
    public function getdistrict()
    {
        return $this->adminmanagementRepositories->getDistrict($this->request);
    }

    public function changepasswordprocess()
    {
        if (!$this->validate(
            [
                'old_password' => 'required|string',
                'new_password' => 'required|string',
                'new_password_con' => 'required|matches[new_password]',
            ]
        )) {
            return redirect()->to('changepassword')->with('notification-danger', '<b>ขออภัย!</b> ข้อมูลการสมัครของคุณไม่ถูกต้อง..');
        } else {
            return $this->adminmanagementRepositories->changePasswordProcess($this->request);
        }
    }
/////member
    public function getPagememberlist()
    {
        return $this->adminmanagementRepositories->getPageListMembers();
    }
    public function getPageApproveMembers()
    {
        return $this->adminmanagementRepositories->getPageApproveMembers();
    }
    public function getPagememberHistory()
    {
        return $this->adminmanagementRepositories->getPageHistoryMember();
    }
    public function getPagememberBanList()
    {
        return $this->adminmanagementRepositories->getPageBanListMember();
    }
    public function getPageEditMember($id)
    {
        return $this->adminmanagementRepositories->getPageEditMember($id);

    }
    public function getMemberShowPage()
    {
        // echo "hello";
        return $this->adminmanagementRepositories->getMemberShowPage($this->request);
    }
    public function updatememberProcess()
    {
        return $this->adminmanagementRepositories->updateMemberProcess($this->request);
    }
    public function approvememberProcess($id)
    {
        return $this->adminmanagementRepositories->approveMemberProcess($id);
    }
    public function banmemberProcess($id)
    {
        return $this->adminmanagementRepositories->banMemberProcess($id);
    }
    public function unbanmemberProcess($id)
    {
        return $this->adminmanagementRepositories->unbanMemberProcess($id);

    }
    public function deletememberProcess($id)
    {
        return $this->adminmanagementRepositories->deleteMemberProcess($id);
    }
////// Company
    public function getPagecompanylist()
    {
        return $this->adminmanagementRepositories->getPageListCompanyall();
    }
    public function getPageApproveCompany()
    {
        return $this->adminmanagementRepositories->getPageApproveCompany();
    }
    public function getPagecompanyBanList()
    {
        return $this->adminmanagementRepositories->getPageBanList();
    }
    public function getPagecompanyHistory()
    {
        return $this->adminmanagementRepositories->getPageHistory();
    }
    public function getPageEditCompany($id)
    {
        return $this->adminmanagementRepositories->getPageEditCompany($id);
    }
    public function getCompanyShowPage()
    {
        return $this->adminmanagementRepositories->getPageListCompany($this->request);
    }
    public function updatecompanyProcess()
    {
        return $this->adminmanagementRepositories->updatecompanyProcess($this->request);
    }
    public function approvecompanyProcess($id)
    {
        return $this->adminmanagementRepositories->approvecompanyProcess($id);
    }
    public function bancompanyProcess($id)
    {
        return $this->adminmanagementRepositories->bancompanyProcess($id);
    }
    public function unbancompanyProcess($id)
    {
        return $this->adminmanagementRepositories->unbancompanyProcess($id);
    }
    public function deletecompanyProcess($id)
    {
        return $this->adminmanagementRepositories->deletecompanyProcess($id);
    }
//// University
    public function getPageuniversitylist()
    {
        return $this->adminmanagementRepositories->getPageListUniversity();
    }
    public function getPageApproveUniversity()
    {
        return $this->adminmanagementRepositories->getPageApproveUniversity();
    }
    public function getPageBanUniversityList()
    {
        return $this->adminmanagementRepositories->getPageBanUniversityList();
    }
    public function getPageHistoryUniversity()
    {
        return $this->adminmanagementRepositories->getPageHistoryUniversity();
    }
    public function getPageEditUniversity($id)
    {
        return $this->adminmanagementRepositories->getPageEditUniversity($id);
    }
    public function getUniversityShowPage()
    {
        return $this->adminmanagementRepositories->getUniversityShowPage($this->request);
    }
    public function updateUniversityProcess()
    {
        return $this->adminmanagementRepositories->updateUniversityProcess($this->request);
    }
    public function approveUniversityProcess($id)
    {
        return $this->adminmanagementRepositories->approveUniversityProcess($id);
    }
    public function banUniversityProcess($id)
    {
        return $this->adminmanagementRepositories->banUniversityProcess($id);
    }
    public function unbanUniversityProcess($id)
    {
        return $this->adminmanagementRepositories->unbanUniversityProcess($id);
    }
    public function deleteUniversityProcess($id)
    {
        return $this->adminmanagementRepositories->deleteUniversityProcess($id);
    }
////// Content
    public function getProvision()
    {
        return $this->adminmanagementRepositories->getPageProvision() ;
    }
   
    public function getContact()
    {
        return $this->adminmanagementRepositories->getPagecontct() ;
    }
    public function getAbout()
    {
        return $this->adminmanagementRepositories->getPageabout();
    }
    public function getPolicy()
    {
        return $this->adminmanagementRepositories->getPagepolicy();
    }
    public function getHelp()
    {
        return $this->adminmanagementRepositories->getPageHelp();
    }
    public function updateProvisionProcess()
    {
        return $this->adminmanagementRepositories->updateProvisionProcecess($this->request);
    }
    public function updateContactProcess()
    {
        return $this->adminmanagementRepositories->updateContactProcecess($this->request);
    }
    public function updateAboutProcess()
    {
        return $this->adminmanagementRepositories->updateAboutProcecess($this->request);
    }
    public function updatePolicyProcess()
    {
        return $this->adminmanagementRepositories->updatePolicyProcecess($this->request);
    }
    public function updateHelpProcess()
    {
        return $this->adminmanagementRepositories->updateHelpProcess($this->request);
    }

}
