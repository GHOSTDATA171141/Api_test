<?php namespace App\Libraries;

define('JWT_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIgmnjadjiMKjjasdhpoqxmPO');
define('JWT_ALGORITHM', 'HS256');
use \Firebase\JWT\JWT;

class UserUtils
{
    public function encryptVerifyKey($member_id, $email)
    {
        if (!empty($member_id) && !empty($email)) {
            $plaintext = $member_id . "|" . $email;
        } else {
            $plaintext = null;
        }
        $plaintext_str = str_rot13($plaintext);
        $ciphertext_base64 = strtr(base64_encode($plaintext_str), '+/=', '._-');
        return $ciphertext_base64;
    }

    public function decryptVerifyKey($ciphertext_base64)
    {
        $ciphertext_dec = base64_decode(strtr($ciphertext_base64, '._-', '+/='));
        $ciphertext_str = str_rot13($ciphertext_dec);
        return $ciphertext_str;
    }

    
    public function jwtTokenDecode($token)
    {
        try {
            $response = (array) JWT::decode($token, JWT_KEY, array(JWT_ALGORITHM));
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'result' => $response
            );
        } catch (\InvalidArgumentException $e) {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Invaild Token'
            );
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Unauthorized'
            );
        }
        return $result;
    }

    public function jwtTokenEncode($data)
    {
        try {
            $result = JWT::encode($data, JWT_KEY);
            return $result;
        } catch (Exception $e) {
            $result = array(
            'resultCode' => 500,
            'resultMessage' => 'failed'
        );
            return $result;
        }
    }
    
    // public function getMemberInfo()
    // {
    //     $memberLogin = $this->CI->auth->getAuth();
    //     if ($memberLogin['resultCode'] == 200) {
    //         return $this->CI->user->getMemberById($memberLogin['data']['member_id']);
    //     } else {
    //         return '';
    //     }
    // }

    // public function getMemberAccess($privilege)
    // {
    //     $isMember = $this->getMemberInfo();
    //     $isAdmin = get_cookie('adminInfo');
    //     if ($privilege === ONLY_MEMBER_ACCESS) {
    //         if (!$isMember) {
    //             return redirect(base_url().'signin');
    //         }
    //     } elseif ($privilege === ONLY_PARTNER_ACCESS) {
    //         if (!$isMember || $isMember['member_type'] != IS_PARTNER) {
    //             return redirect(base_url().'signin');
    //         }
    //     } elseif ($privilege === ONLY_CUSTOMER_ACCESS) {
    //         if ($isMember) {
    //             return redirect(base_url());
    //         }
    //     } elseif ($privilege === ONLY_ADMIN_ACCESS) {
    //         if (!$isAdmin) {
    //             return redirect(base_url());
    //         }
    //     }
    // }
}