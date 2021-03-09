<?php namespace App\Modules\Adminmanagement\Repositories;

use App\Modules\Adminmanagement\Models\AdminmanagementModel;
use CodeIgniter\Controller;
use App\Modules\User\Models\UserModel;
use CodeIgniter\I18n\Time;
use DateTime;

class AdminmanagementRepositories extends Controller
{

    private $adminmanagementModel;
    private $userModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->adminmanagementModel = new AdminmanagementModel();
        $this->userModel = new UserModel();
    }
///// admin

    public function getAdminPage()
    {
        $adminList = $this->adminmanagementModel->getAdminList();
        $data = [
            'title' => 'Admin List',
            'view' => 'adminmanagement/admin-list',
            'data' => $adminList,
        ];
        return view('template/layout', $data);
    }
    public function getAddAdminPage()
    {

        $data = [
            'title' => 'Add Admin',
            'view' => 'adminmanagement/admin-add',
            'data' => ''
        ];
        return view('template/layout', $data);
    }
    public function editAdmin($id)
    {
        $userInfo = $this->adminmanagementModel->getAdminById($id);
        $data = [
            'title' => 'Admin Edit',
            'view' => 'adminmanagement/admin-edit',
            'data' => $userInfo
        ];
        return view('template/layout', $data);
    }

    public function update($request)
    {
        $id = $request->getVar('_id');
        $newData = [
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),

        ];

        $updateUser =  $this->adminmanagementModel->updateAdmin($id, $newData);
        if ($updateUser['resultCode'] == 200) {
            return redirect()->to(site_url() . 'adminmanagement')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->to(site_url() . 'adminmanagement')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }

    public function getaddadmin($request)
    {  
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
         $param = [
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
            'admin_email' => $request->getVar('email'),
            'username' => $request->getVar('email'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
            'created_at'=>$datetime,
        ];
        // dd($param );
        $createAccount = $this->adminmanagementModel->createUserAccountadmin($param);
        if ($createAccount['resultCode'] == 200) {
            return redirect()->to(site_url() . 'adminmanagement/add')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->to(site_url() . 'adminmanagement/add')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteAdmin($id)
    {
        $deleteUser =  $this->adminmanagementModel->deleteAdminById($id);

        if ($deleteUser['resultCode'] == 200) {
            return redirect()->to(site_url() . 'adminmanagement')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else if ($deleteUser['resultCode'] == 403) {
            return redirect()->to(site_url() . 'adminmanagement')->with('notification-danger', '<b>ขออภัย!</b> ไม่มีสิทธิ์ในการดำเนินการ');
        } else {
            return redirect()->to(site_url() . 'adminmanagement')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getChangePassword()
    {
        $data = [
            'title' => 'Change Password',
            'view' => 'adminmanagement/admin-changepassword',
            'data' => ""
        ];

        return view('template/layout', $data);
    }
    public function changePasswordProcess($request)
    {

        $old_password = $request->getVar('old_password');
        $new_password = $request->getVar('new_password');
        $this->userModel = new UserModel;
        $memberAuth = $this->adminmanagementModel->getUserAuth();
        $dataUser = $memberAuth['data'];
        $idUser = $dataUser['admin_id'];
        if (!password_verify($old_password, $dataUser['password'])) {
            return redirect()->to('changepassword')->with('notification-danger', '<b>ขออภัย!</b> รหัสของคุณไม่ถูกต้อง..1');
        } else {
            $param = [
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            ];
            $updatePasswordUser =  $this->usadminmanagementModelerModel->updateUser($idUser, $param);
            if ($updatePasswordUser['resultCode'] == 200) {
                return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>รหัสของคุณถูกเปลี่ยนแล้ว..');
            } else {
                return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> รหัสของคุณไม่ถูกต้อง..2');
            }
        }
    }
    public function getProvince()
    {
        $province = $this->adminmanagementModel->getProvince();
        $output = ' ';
        foreach ($province = (object) $province as $row) {
            $output .= '<option value="' . $row['province_id'] . '">' . $row['province_name_th'] . ' </option>';
        }
        return $output;
        // return json_encode($amphur);
    }
    public function getAmphur($request)
    {
        $provice_id = $request->getVar('province_id');
        $amphur = $this->adminmanagementModel->getAmphur($provice_id);
        $output = '<option value="">= เลือก =</option>';
        foreach ($amphur = (object) $amphur as $row) {
            $output .= '<option value="' . $row['amphur_id'] . '">' . $row['amphur_name_th'] . ' </option>';
        }
        return $output;
        // return json_encode($amphur);
    }

    public function getDistrict($request)
    {
        $amphur_id = $request->getVar('amphur_id');
        $district = $this->adminmanagementModel->getDistrict($amphur_id);
        $output = '<option value="">= เลือก =</option>';
        foreach ($district = (object) $district as $row) {
            $output .= '<option value="' . $row['district_id'] . '">' . $row['district_name_th'] . ' </option>';
        }
        return $output;
        // return json_encode($amphur);
    }
////////////// Member
    public function getPageListMembers()
	{
		$data = [
		    'title' => 'MemberManagement',
            'view' => 'member/member-list',
            'data' => $this->adminmanagementModel->getAllMembers(),
        ];

		return view('template/layout', $data);
    }
    public function getPageApproveMembers()
	{ $condition = ['status'=>0];
        $memberApprove = $this->adminmanagementModel->getAllMemberWithCondition($condition);

		$data = [
		    'title' => 'MemberManagement',
            'view' => 'member/member-approve',
            'data' => $memberApprove,
        ];

		return view('template/layout', $data);
    }
    public function getPageHistoryMember()
    {
        $data = [
		    'title' => 'MemberManagement',
            'view' => 'member/member-history',
            'data' => $this->adminmanagementModel->getAllMembers(),
        ];

		return view('template/layout', $data);
    }
    public function getPageBanListMember()
    {
        $condition = ['status'=>2];
        $memberBanList = $this->adminmanagementModel->getAllMemberWithCondition($condition);
        $data = [
		    'title' => 'MemberManagement',
            'view' => 'member/member-ban',
            'data' => $memberBanList,
        ];

		return view('template/layout', $data);
    }
    public function getPageEditMember($id)
    {
        $memberInfo = $this->adminmanagementModel->getMemberById($id);
        $provincename = $this->adminmanagementModel->getProvinceByIdMember($memberInfo[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdMember($memberInfo[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdMember($memberInfo[0]['district']);

        if($memberInfo[0]['province']==''){
            $memberInfo[0]['provinceID']="";
            $memberInfo[0]['provinceName']="เลือก";

        }else{
                $memberInfo[0]['provinceID']= $provincename[0]['province_id'] ;
                $memberInfo[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }
        if($memberInfo[0]['amphur']==''){
            $memberInfo[0]['amphurID']="";
            $memberInfo[0]['amphurName']="เลือก";
        }else{
            $memberInfo[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $memberInfo[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }
        if($memberInfo[0]['district']==''){
            $memberInfo[0]['districtID']="";
            $memberInfo[0]['districtName']="เลือก";
        }else{
            $memberInfo[0]['districtID']= $districtname[0]['district_id'] ;
            $memberInfo[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }

        // dd($districtname);
        $data = [
            'title' => 'Member Edit',
            'view' => 'member/member-edit',
            'data' => $memberInfo
        ];
     
        return view('template/layout', $data);

    }
    public function getMemberShowPage($request)
    {
        $member_id = $request->getVar('reqid');
        $member = $this->adminmanagementModel->getMemberById($member_id);
        $provincename = $this->adminmanagementModel->getProvinceByIdMember($member[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdMember($member[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdMember($member[0]['district']);

        if($member[0]['province']==''){
            $member[0]['provinceID']="";
            $member[0]['provinceName']="";

        }else{
                $member[0]['provinceID']= $provincename[0]['province_id'] ;
                $member[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }

        if($member[0]['amphur']==''){
            $member[0]['amphurID']="";
            $member[0]['amphurName']="";
        }else{
            $member[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $member[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }

        if($member[0]['district']==''){
            $member[0]['districtID']="";
            $member[0]['districtName']="";
        }else{
            $member[0]['districtID']= $districtname[0]['district_id'] ;
            $member[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }
        $response = 
        '<div class="container">
        <table width="100%" border="0">
        <thead><tr><th width="50%"> </th>
        <th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($member as $row) 
        {
        $response .=
            '<td style="padding:30px"><img width="100%" src=""></td>';
        $response .= '<td style="vertical-align: top; padding:30px">';
        $response .=
            '<p class="lead"><strong>ชื่อสมาชิก :'.
            $row['fullname'].'  
            </p></strong>
            <p style="line-height: 2.0;">Email : '.
            $row['member_email'].'
            <br>เบอร์โทร :  '.
            $row['phone'].'
            <br>เลขประจำตัวประชาชน : '.
            $row['idcard'].' 
            <br>รายละเอียด :'.
            $row['dob'].''.$row['gender'].'
            <br>ที่อยู่ :'.
            $row['address']." ".$row['provinceName']."  ".$row['amphurName']."  ".$row['districtName']."  ".$row['zipcode'].' ';
        $response .=
            '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            เข้าใช่ล่าสุด :  '.
            $row['created_at'].' 
            <br>อัปเดทล่าสุด :'.
            $row['updated_at'].' 
            <br>สร้างเมื่อ :'.
            $row['created_at'].'
            <br>อนุมัติเมื่อ :'.
            $row['approved_date'].'<br> ';
        $response .= '</td></tr>';
        $response .= '</tbody></table></div> </p> ';

        }
        return $response;
    }
    public function updateMemberProcess($request)
    {
        $member_id = $request->getVar('id');
        $data = [
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
            'fullname' => $request->getVar('firstname') . ' ' . $request->getVar('lastname'),
            'status' => $request->getVar('status'),
            'idcard' => $request->getVar('idcard'),
            'dob' => $request->getVar('dob'),
            'member_email' => $request->getVar('email'),
            'phone' => $request->getVar('phone'),
            'province' => $request->getVar('province_id'),
            'amphur' => $request->getVar('amphur_id'),
            'district' => $request->getVar('district_id'),
            'address' => $request->getVar('address'),
            'zipcode' => $request->getVar('zipcode'),
        ];
   
        $update =  $this->adminmanagementModel->updateMemberById($member_id,$data);
        if ($update['resultCode'] == 200) {
            return redirect()->to('')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->to('')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }

    }
    public function approveMemberProcess($id)
    {
        $member_id =$id;
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
        $data = 
        [
            'approved_date'=>$datetime,
            'status'=>'1',
        ]; 
        $approvemember =  $this->adminmanagementModel->updateMemberById($member_id,$data);

        if ($approvemember['resultCode'] == 200) {
            return redirect()->back('')->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back('')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }


    }
    public function banMemberProcess($id)
    {
        $member_id =$id;
        $data = 
        [
            'status'=>'2',
        ]; 
        $approve =  $this->adminmanagementModel->updateMemberById($member_id,$data);
    
        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbanMemberProcess($id)
    {
        $member_id =$id;
        $data = 
        [
            'status'=>'1',
        ]; 
        $approve =  $this->adminmanagementModel->updateMemberById($member_id,$data);

        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }

    }
    public function deleteMemberProcess($id)
    {
        $deletemember =  $this->adminmanagementModel->deleteMemberById($id);
        if ($deletemember['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        }else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
///// Company
    public function getPageListCompanyall()
    {
        $data = [
            'title' => 'CompanyManagement',
            'view' => 'company/company-list',
            'data' => $this->adminmanagementModel->getAllCompany(),
        ];

        return view('template/layout', $data);
    }

    public function getPageApproveCompany()
    {
        $condition = ['cou_status' => 0, 'cou_type' => 2];
        $company = $this->adminmanagementModel->getAllCompanyWithCondition($condition);
        $data = [
            'title' => 'CompanyManagement',
            'view' => 'company/company-approve',
            'data' => $company,
        ];
        return view('template/layout', $data);
    }

    public function getPageBanList()
    {
        $condition =  ['cou_status' => 2, 'cou_type' => 2];
        $company = $this->adminmanagementModel->getAllCompanyWithCondition($condition); {
            $data = [
                'title' => 'CompanyManagement',
                'view' => 'company/company-ban',
                'data' => $company,
            ];

            return view('template/layout', $data);
        }
    }
    public function getPageHistory()
    {
        $condition = ['cou_status' != 0, 'cou_type' => 2];
        $company = $this->adminmanagementModel->getAllCompanyWithCondition($condition); {
            $data = [
                'title' => 'CompanyManagement',
                'view' => 'company/company-history',
                'data' => $company,
            ];

            return view('template/layout', $data);
        }
    }
    public function getPageEditCompany($id)
    {
        $comInfo = $this->adminmanagementModel->getcompanyById($id);

        $provincename = $this->adminmanagementModel->getProvinceByIdCompany($comInfo[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdCompany($comInfo[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdCompany($comInfo[0]['district']);
       
        if($comInfo[0]['province']==''){
            $comInfo[0]['provinceID']="";
            $comInfo[0]['provinceName']="เลือก";

        }else{
                $comInfo[0]['provinceID']= $provincename[0]['province_id'] ;
                $comInfo[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }
        if($comInfo[0]['amphur']==''){
            $comInfo[0]['amphurID']="";
            $comInfo[0]['amphurName']="เลือก";
        }else{
            $comInfo[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $comInfo[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }
        if($comInfo[0]['district']==''){
            $comInfo[0]['districtID']="";
            $comInfo[0]['districtName']="เลือก";
        }else{
            $comInfo[0]['districtID']= $districtname[0]['district_id'] ;
            $comInfo[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }
        $data = [
            'title' => 'University Edit',
            'view' => 'company/company-edit',
            'data' => $comInfo
        ];
        return view('template/layout', $data);
    }
    public function getPageListCompany($request)
    {
        $cou_id = $request->getVar('reqid');
        $cou = $this->adminmanagementModel->getCompanyById($cou_id);
        $provincename = $this->adminmanagementModel->getProvinceByIdCompany($cou[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdCompany($cou[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdCompany($cou[0]['district']);

        if($cou[0]['province']==''){
            $cou[0]['provinceID']="";
            $cou[0]['provinceName']="";

        }else{
                $cou[0]['provinceID']= $provincename[0]['province_id'] ;
                $cou[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }

        if($cou[0]['amphur']==''){
            $cou[0]['amphurID']="";
            $cou[0]['amphurName']="";
        }else{
            $cou[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $cou[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }

        if($cou[0]['district']==''){
            $cou[0]['districtID']="";
            $cou[0]['districtName']="";
        }else{
            $cou[0]['districtID']= $districtname[0]['district_id'] ;
            $cou[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }
        $response =
            '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($cou = (object) $cou as $row) {
            $response .=
                '<td style="padding:30px"><img width="100%" src=""></td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อบริษัท :' .
                $row['cou_name_th'] . '  
            ' . $row['cou_name_en'] . '
            </p></strong>
            <p style="line-height: 2.0;">Email : ' .
                $row['cou_email'] . '
            <br>เบอร์โทร :  ' .
                $row['cou_tel_number'] . '
            <br>เลขประจำตัวผู้เสียภาษี : ' .
                $row['cou_taxpayer_number'] . ' 
            <br>รายละเอียด :  ' .
                $row['cou_description'] . '
            <br>ที่อยู่ :  ' .
                $row['cou_address'] . '' . $row['provinceName'] . "  " . $row['amphurName'] . "  " . $row['districtName'] . "  " . $row['zipcode'] . '';
            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            เข้าใช่ล่าสุด :  ' .
                $row['created_at'] . ' 
            <br>อัปเดทล่าสุด :' .
                $row['updated_at'] . ' 
            <br>สร้างเมื่อ :' .
                $row['created_at'] . '
            <br>อนุมัติเมื่อ :' .
                $row['cou_approved_at'] . '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div>';
        }
        return $response;
    }
    public function updatecompanyProcess($request)
    {
        $time   = new DateTime('now');
        $datetime = Time::instance($time, 'THAI/BKK');
        $id = $request->getVar('id');
        $data = [
            'cou_name_th' => $request->getVar('firstname'),
            'cou_name_en' => $request->getVar('lastname'),
            'cou_description' => $request->getVar('description'),
            // 'username' => $request->getVar('username'),
            // category
            'cou_uni_major' => $request->getVar('major'),
            'cou_category' => $request->getVar('category'),
            'cou_taxpayer_number' => $request->getVar('idcard'),
            'cou_email' => $request->getVar('email'),
            'cou_tel_number' => $request->getVar('phone'),
            'cou_address' => $request->getVar('address'),
            'cou_status' => $request->getVar('status'),
            'province' => $request->getVar('province_id'),
            'amphur' => $request->getVar('amphur_id'),
            'district' => $request->getVar('district_id'),
            'zipcode' => $request->getVar('zipcode'),
            'updated_at' => $datetime,
        ];
        // dd($newData);
        $update =  $this->adminmanagementModel->updatecompanyById($id, $data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }

    public function approvecompanyProcess($id)
    {
        $cou_id = $id;
        $time   = new DateTime('now');
        $datetime = Time::instance($time, 'THAI/BKK');
        $data =
            [
                'cou_approved_at' => $datetime,
                'cou_status' => '1',
            ];
        $approvecompany =  $this->adminmanagementModel->updatecompanyById($cou_id, $data);
        // dd($approvecompany);
        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function bancompanyProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'cou_status' => '2',
            ];
        $approvecompany =  $this->adminmanagementModel->updatecompanyById($cou_id, $data);
        // dd($approvecompany);
        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbancompanyProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'cou_status' => '1',
            ];
        $approvecompany =  $this->adminmanagementModel->updatecompanyById($cou_id, $data);
        // dd($approvecompany);
        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deletecompanyProcess($id)
    {
        $deleteCompany =  $this->adminmanagementModel->deleteCompanyById($id);
        if ($deleteCompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
///// University
    public function getPageListUniversity()
	{
		$data = [
		    'title' => 'UniversityManagement',
            'view' => 'university/university-list',
            'data' => $this->adminmanagementModel->getAllUniversity(),
        ];

		return view('template/layout', $data);
    }
    public function getPageApproveUniversity()
    {
        $condition = ['cou_status'=>0,'cou_type'=>1];
        $company = $this->adminmanagementModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'Approve',
            'view' => 'university/university-approve',
            'data' =>  $company,
        ];
        return view('template/layout', $data);
    }
    public function getPageBanUniversityList()
    {
        $condition = ['cou_status'=>2,'cou_type'=>1];
        $company = $this->adminmanagementModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'BanUniversity',
            'view' => 'university/universuty-banapprove',
            'data' => $company,
        ];
        return view('template/layout', $data);
    }
    public function getPageHistoryUniversity()
    {
        $condition = ['cou_status'!=0,'cou_type'=>1];
        $company = $this->adminmanagementModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'HisUniversity',
            'view' => 'university/university-hisapprove',
            'data' => $company,
        ];
        return view('template/layout', $data);
    }
    public function getPageEditUniversity($id)
    {
        $proInfo = $this->adminmanagementModel->getUniversityById($id);
        $provincename = $this->adminmanagementModel->getProvinceByIdUniversity($proInfo[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdUniversity($proInfo[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdUniversity($proInfo[0]['district']);

        if($proInfo[0]['province']==''){
            $proInfo[0]['provinceID']="";
            $proInfo[0]['provinceName']="เลือก";

        }else{
                $proInfo[0]['provinceID']= $provincename[0]['province_id'] ;
                $proInfo[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }
        if($proInfo[0]['amphur']==''){
            $proInfo[0]['amphurID']="";
            $proInfo[0]['amphurName']="เลือก";
        }else{
            $proInfo[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $proInfo[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }
        if($proInfo[0]['district']==''){
            $proInfo[0]['districtID']="";
            $proInfo[0]['districtName']="เลือก";
        }else{
            $proInfo[0]['districtID']= $districtname[0]['district_id'] ;
            $proInfo[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }
        $data = [
            'title' => 'University Edit',
            'view' => 'university/university-update',
            'data' => $proInfo
        ];
        // dd($userInfo);
        return view('template/layout', $data);
    }
    public function updateUniversityProcess($request)
    {
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
        $id = $request->getVar('id');
        $data = [
            'cou_name_th' => $request->getVar('firstname'),
            'cou_name_en' => $request->getVar('lastname'),
            'cou_description' => $request->getVar('description'),
            'cou_taxpayer_number' => $request->getVar('idcard'),
            'cou_email' => $request->getVar('email'),
            'cou_tel_number' => $request->getVar('phone'),
            'cou_address' => $request->getVar('address'),
            // cou_status
            'cou_uni_faculty' => $request->getVar('faculty'),
            'cou_uni_major' => $request->getVar('major'),
            'cou_status' => $request->getVar('status'),
            'province' => $request->getVar('province_id'),
            'amphur' => $request->getVar('amphur_id'),
            'district' => $request->getVar('district_id'),
            'zipcode' => $request->getVar('zipcode'),
            'updated_at'=>$datetime,
        ];
        // dd($data);
        $update =  $this->adminmanagementModel->updateUniversityById($id,$data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function approveUniversityProcess($id)
    {
        $cou_id =$id;
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
        $data = 
        [
            'cou_approved_at'=>$datetime,
            'cou_status'=>'1',
        ]; 
        $approveUniversity =  $this->adminmanagementModel->updateUniversityById($cou_id,$data);
        // dd($time);
        if ($approveUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function banUniversityProcess($id)
    {
        $cou_id =$id;
        $data = 
        [
            'cou_status'=>'2',
        ]; 
        $approveUniversity =  $this->adminmanagementModel->updateUniversityById($cou_id,$data);
        if ($approveUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbanUniversityProcess($id)
    {
        $cou_id =$id;
        $data = 
        [
            'cou_status'=>'1',
        ]; 
        $unlockUniversity =  $this->adminmanagementModel->updateUniversityById($cou_id,$data);
        //  dd($unlockUniversity);
        if ($unlockUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteUniversityProcess($id)
    {
        $deleteUniversity =  $this->adminmanagementModel->deleteUniversityById($id);
        // dd($deleteUniversity);
        if ($deleteUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        }else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getUniversityShowPage($request)
    {
        $cou_id = $request->getVar('reqid');
        $cou = $this->adminmanagementModel->getUniversityById($cou_id);
        $provincename = $this->adminmanagementModel->getProvinceByIdUniversity($cou[0]['province']);
        $amphurname = $this->adminmanagementModel->getAmphurByIdUniversity($cou[0]['amphur']);
        $districtname = $this->adminmanagementModel->getDistrictByIdUniversity($cou[0]['district']);

        if($cou[0]['province']==''){
            $cou[0]['provinceID']="";
            $cou[0]['provinceName']="";

        }else{
                $cou[0]['provinceID']= $provincename[0]['province_id'] ;
                $cou[0]['provinceName']= $provincename[0]['province_name_th'] ;
        }

        if($cou[0]['amphur']==''){
            $cou[0]['amphurID']="";
            $cou[0]['amphurName']="";
        }else{
            $cou[0]['amphurID']= $amphurname[0]['amphur_id'] ;
            $cou[0]['amphurName']= $amphurname[0]['amphur_name_th'] ;    
        }

        if($cou[0]['district']==''){
            $cou[0]['districtID']="";
            $cou[0]['districtName']="";
        }else{
            $cou[0]['districtID']= $districtname[0]['district_id'] ;
            $cou[0]['districtName']= $districtname[0]['district_name_th'] ;   
        }
        $response =
        '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($cou = (object) $cou as $row) 
        {
        $response .=
            '<td style="padding:30px"><img width="100%" src=""></td>';
        $response .= '<td style="vertical-align: top; padding:30px">';
        $response .=
            '<p class="lead"><strong>ชื่อบริษัท :'.
            $row['cou_name_th'].'  
            '.$row['cou_name_en'].'
            </p></strong>
            <p style="line-height: 2.0;">Email : '.
            $row['cou_email'].'
            <br>เบอร์โทร :  '.
            $row['cou_tel_number'].'
            <br>เลขประจำตัวผู้เสียภาษี : '.
            $row['cou_taxpayer_number'].' 
            <br>รายละเอียด :  '.
            $row['cou_description'].'
            <br>ที่อยู่ :  '.
            $row['cou_address'].' จังหวัด '.$row['provinceName']." อำเภอ/เขต ".$row['amphurName']." ตำบล/แขวง ".$row['districtName']."  ".$row['zipcode'].' ';
    
        $response .=
            '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            เข้าใช่ล่าสุด :  '.
            $row['created_at'].' 
            <br>อัปเดทล่าสุด :'.
            $row['updated_at'].' 
            <br>สร้างเมื่อ :'.
            $row['created_at'].'
            <br>อนุมัติเมื่อ :'.
            $row['cou_approved_at'].'<br> ';
        $response .= '</td></tr>';
        $response .= '</tbody></table></div>';
        }
        return $response;
    }
///// Contact
    public function getPageProvision()
    {
        $data = [
            'title' => 'Provision(ContentManagement)',
            'view' => 'content/content-provision',
            'data' => $this->adminmanagementModel->getAllProvision(),
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function getPagecontct()
    {
        $data = [
            'title' => 'Contact(ContentManagement)',
            'view' => 'content/content-contact',
            'data' => $this->adminmanagementModel->getAllContact(),
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function getPageabout()
    {
        $data = [
            'title' => 'About(ContentManagement)',
            'view' => 'content/content-about',
            'data' => $this->adminmanagementModel->getAllAbout(),
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function getPagepolicy()
    {
        $data = [
            'title' => 'Policy(ContentManagement)',
            'view' => 'content/content-policy',
            'data' => $this->adminmanagementModel->getAllPolicy(),
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function getPageHelp()
    {
        $data = [
            'title' => 'Help(ContentManagement)',
            'view' => 'content/content-help',
            'data' => $this->adminmanagementModel->getAllHelp(),
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function updateProvisionProcecess($request)
    {
        $id = $request->getVar('id');
        $data = [
            'provision' => $request->getVar('provision_detail')
        ];
        // dd($data,$id);
        $update =  $this->adminmanagementModel->updateProvisionById($id,$data);
        // dd($update);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }

    public function updateContactProcecess($request)
    {
        $id = $request->getVar('id');
        $data = [
            'conus_address' => $request->getVar('address'),
            'conus_ourservice' => $request->getVar('ourservice'),
            'conus_email' => $request->getVar('email'),
            'conus_email1' => $request->getVar('email1'),
            'conus_email2' => $request->getVar('email2'),
            'conus_tel' => $request->getVar('phone'),
            'conus_facebook' => $request->getVar('facebook'),
            'conus_youtube' => $request->getVar('youtube'),
            'conus_line' => $request->getVar('line'),
            'conus_instagram' => $request->getVar('instagram'),
            'conus_latlon' => $request->getVar('latlon'),
        ];
        // dd($newData);
        $update =  $this->adminmanagementModel->updateContactById($id,$data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }

    }
    public function updateAboutProcecess($request)
    {
        $id = $request->getVar('id');
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
        $data = [
            'aboutus_container_1_title' => $request->getVar('abouthead'),
            'aboutus_container_1_detail' => $request->getVar('aboutdetail'),
            'aboutus_container_2_title' => $request->getVar('abouthead_2'),
            'aboutus_container_2_detail' => $request->getVar('aboutdetail_2'),
            'lastupdate_date' =>$datetime,
        ];
        // dd($newData);
        $update =  $this->adminmanagementModel->updateAboutById($id,$data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function updatePolicyProcecess($request)
    {
        $id = $request->getVar('id');
        $time   = new DateTime('now');
        $datetime = Time::instance($time,'THAI/BKK');
        $data = [
            'po_container_1_title' => $request->getVar('abouthead'),
            'po_container_1_detail' => $request->getVar('aboutdetail'),
            'po_container_2_title' => $request->getVar('abouthead_2'),
            'po_container_2_detail' => $request->getVar('aboutdetail_2'),
            'po_container_3_title' => $request->getVar('abouthead_3'),
            'po_container_3_detail' => $request->getVar('aboutdetail_3'),
            'lastupdate_date' =>$datetime,
        ];
        // dd($newData);
        $update =  $this->adminmanagementModel->updatePolicyById($id,$data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }

    }
    public function updateHelpProcess($request)
    {
        $id = $request->getVar('id');
        $data = [
            'help_detail' => $request->getVar('help_detail')
        ];
        // dd($data,$id);
        $update =  $this->adminmanagementModel->updateHelpById($id,$data);
        // dd($update);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
        
    }

//// Job 
    public function getPageJob()
    {
        $job = $this->adminmanagementModel->getAllJob();
        $data = [
            'title' => 'Job Management',
            'view' => 'job/job-list',
            'data' => $job,
        ];
        // dd($data);
        return view('template/layout', $data);
    }
    public function getPagedit($id)
    {
        $job = $this->adminmanagementModel->getJobById($id);
        $data = [
            'title' => 'Job Management',
            'view' => 'job/job-edit',
            'data' => $job,
        ];
        // dd($id);
        return view('template/layout', $data);

    }
}
