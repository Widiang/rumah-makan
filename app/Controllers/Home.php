<?php

namespace App\Controllers;
use App\Models\M_lelang;
class Home extends BaseController
{
    public function index()
    {
        $model= new M_lelang();
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);

    echo view('Login', $data);

    }

    public function __construct()
    {
        // No need to call parent::__construct(); CodeIgniter handles that internally.
    }

    public function index1()
    {
        // Load the database connection when needed
        $this->db = \Config\Database::connect();

        // Optional: customize the DB connection settings
        $this->db->query('SET SESSION sql_mode = ""');

        // Proceed with your method logic
        // ...
    }



    public function aksi_login() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $backupCaptcha = $this->request->getPost('backup_captcha');
    
        // Check if the server is online
        if ($this->isOnline()) {
            $secretKey = '6LeAgCAqAAAAACi34dd-ob9stqzW69GDXnxPpLr7'; // Your secret key
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
            $responseKeys = json_decode($response, true);
    
            if (intval($responseKeys["success"]) !== 1) {
                session()->setFlashdata('error', 'Please complete the reCAPTCHA.');
                return redirect()->to('home');
            }
        } else {
            // Validate offline CAPTCHA
            if (!empty($backupCaptcha)) {
                if (!$this->validateOfflineCaptcha($backupCaptcha)) {
                    session()->setFlashdata('error', 'Offline CAPTCHA validation failed.');
                    return redirect()->to('home/login');
                }
            } else {
                session()->setFlashdata('error', 'Please complete the offline CAPTCHA.');
                return redirect()->to('home/login');
            }
        }
        $model = new M_lelang();
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
        
            $cek = $model->getWhere('user', $where);
        if ($cek > 0) {
                    session()->set('username', $cek->username);
                    session()->set('id_user', $cek->id_user);
                    session()->set('level', $cek->level);
            
                    // Log the login activity
                    $model->logActivity($cek->id_user, 'login', 'User logged in.');
            
                    return redirect()->to('home/dashboard_L');
                } else {
                    return redirect()->to('http://localhost:8080/home/login');
                }
    }
    
    // Function to check network connectivity
    private function isOnline() {
        $connected = @fsockopen("www.google.com", 80); 
        // Check if a connection is made
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }
        private function validateOfflineCaptcha($captchaInput)
        {
            // Ambil CAPTCHA yang disimpan di session
            $storedCaptcha = session()->get('captcha_code');
    
            // Bandingkan input pengguna dengan CAPTCHA yang disimpan (peka huruf besar/kecil)
            return $captchaInput === $storedCaptcha;
        }
        public function generateCaptcha()
        {
            $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    
            // Store the CAPTCHA code in the session
            session()->set('captcha_code', $code);
    
            // Generate the image
            $image = imagecreatetruecolor(120, 40);
            $bgColor = imagecolorallocate($image, 255, 255, 255);
            $textColor = imagecolorallocate($image, 0, 0, 0);
    
            imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
            imagestring($image, 5, 10, 10, $code, $textColor);
    
            // Set the content type header - in this case image/png
            header('Content-Type: image/png');
    
            // Output the image
            imagepng($image);
    
            // Free up memory
            imagedestroy($image);

    }
    
    // public function aksi_login() {
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');
    //     $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
    //     $secretKey = '6LeAgCAqAAAAACi34dd-ob9stqzW69GDXnxPpLr7'; // Your secret key
    //     $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
    //     $responseKeys = json_decode($response, true);
    
    //     if (intval($responseKeys["success"]) !== 1) {
    //         // If reCAPTCHA validation fails
    //         session()->setFlashdata('error', 'Please complete the reCAPTCHA.');
    //         return redirect()->to('home');
    //     }
    
    //     $model = new M_lelang();
    //     $where = array(
    //         'username' => $username,
    //         'password' => md5($password)
    //     );
    
    //     $cek = $model->getWhere('user', $where);
        
    //     if ($cek > 0) {
    //         session()->set('username', $cek->username);
    //         session()->set('id_user', $cek->id_user);
    //         session()->set('level', $cek->level);
    
    //         // Log the login activity
    //         $model->logActivity($cek->id_user, 'login', 'User logged in.');
    
    //         return redirect()->to('home/dashboard_L');
    //     } else {
    //         return redirect()->to('http://localhost:8080/home/login');
    //     }
    // }
    
    
    
    public function logout() {
        $user_id = session()->get('id_user');
        
        if ($user_id) {
            // Log the logout activity
            $model = new M_lelang();
            $model->logActivity($user_id, 'logout', 'User logged out.');
        }
    
        session()->destroy();
        return redirect()->to('http://localhost:8080/home');
    }
    public function dashboard_L()
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
      
        $model->logActivity($user_id, 'View', 'User view Dashboard.');
        echo view('header', $data);
        echo view('menu_L',  $data);
        echo view('dashboard_L', $data); // Make sure to pass $data if needed in the view
        echo view('footer_L');
    } else {
        return redirect()->to('home/notfound');
    }
}

    public function notfound()
    {
        $model= new M_lelang();
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['satu'] = reset($filteredLogo);
    echo view('menu_L', $data);
    echo view('notfound');

    }
   
  
    public function inprogress()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
    $data['sa'] = $model->joinThreeTables('transaksi',
    'menu',
    'minuman',
    'transaksi.id_menu = menu.id_menu',
    'transaksi.id_minuman = minuman.id_minuman', []);

    $data['s'] = $model->tampil('menu', 'id_menu');
    $data['t'] = $model->tampil('minuman', 'id_minuman');;
    $model->logActivity($user_id, 'View', 'User view Inprogress.');
    echo view('header', $data);
    echo view('menu_L',$data);
    echo view('INPROGRESS',$data);
    echo view('footer_L');
    
} else {
    return redirect()->to('home/notfound');
}
}
     public function order()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $data['satu'] = reset($filteredLogo);
         $where=array('id_user'=>session()->get('id_user'));
         $data['user']=$model->getWhere('user', $where);
    $where=array('id_user'=>session()->get('id_user'));
    $data['sa'] = $model->joinThreeWhere('transaksi',
        'menu',
        'minuman',
        'transaksi.id_menu = menu.id_menu',
        'transaksi.id_minuman = minuman.id_minuman', []);
    
        $data['s'] = $model->tampil('menu', 'id_menu');
        $data['t'] = $model->tampil('minuman', 'id_minuman');
        $model->logActivity($user_id, 'View', 'User view Order.');

            echo view('header', $data);
            echo view('menu_L',$data);
              echo view('order');
            echo view('footer_L');
    
} else {
    return redirect()->to('home/notfound');
}
    }
    
    public function aksi_order()
    {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('nama');
        $c = $this->request->getPost('Tanggal');
        $d = $this->request->getPost('jenis1');
        $e = $this->request->getPost('jenis2');
        $j = $this->request->getPost('totalM');
        $g = $this->request->getPost('totalMI');
        $totalHarga = $this->request->getPost('totalHarga');
        
        // Get the current year
        $year = date('Y');
        
        // Get the next sequence number
        $latestNomor = $model->getLatestNomor($year);
        $sequence = $latestNomor ? intval(substr($latestNomor, -2)) + 1 : 1;
        
        // Format the sequence number
        $nomor = sprintf('NO-%s-%02d', $year, $sequence);
        
        // Prepare data for insertion
        if (!empty($d) && !empty($e)) {
            for ($i = 0; $i < count($d); $i++) {
                $isi = array(
                    'Nomor' => $nomor,
                    'user' => $a,
                    'pending' => 'pending',
                    'Selesai' => 'pending',
                    'admin' => "petugas",
                    'tanggal' => $c,
                    'id_menu' => $d[$i],
                    'total_menu' => $j[$i],
                    'id_minuman' => $e[$i],
                    'total_minuman' => $g[$i],
                    'progress' => "inprogress",
                    'total_harga' => $totalHarga,
                );
                print_r($isi);
                $model->tambah('transaksi', $isi);
            }
        } 
        elseif (!empty($d)) {
            for ($i = 0; $i < count($d); $i++) {
                $isi = array(
                    'Nomor' => $nomor,
                    'user' => $a,
                    'pending' => 'pending',
                    'Selesai' => 'pending',
                    'admin' => "petugas",
                    'tanggal' => $c,
                    'id_menu' => $d[$i],
                    'total_menu' => $j[$i],
                    'id_minuman' => '5',
                    'total_minuman' => '0',
                    'progress' => "inprogress",
                    'total_harga' => $totalHarga,
                );
                print_r($isi);
                $model->tambah('transaksi', $isi);
            }
        } 
        elseif (!empty($e)) {
            for ($f = 0; $f < count($e); $f++) {
                $isi = array(
                    'Nomor' => $nomor,
                    'user' => $a,
                    'pending' => 'pending',
                    'Selesai' => 'pending',
                    'admin' => "petugas",
                    'tanggal' => $c,
                    'id_menu' => '14',
                    'total_menu' => '0',
                    'id_minuman' => $e[$f],
                    'total_minuman' => $g[$f],
                    'progress' => "inprogress",
                    'total_harga' => $totalHarga
                );
                print_r($isi);
                $model->tambah('transaksi', $isi);
            }
        }
    
        // Log the transaction activity once
        $model->logActivity($user_id, 'Transaction', 'User Has Made a Transaction.');
        
        // Redirect to 'inprogress' page
        return redirect()->to(base_url('home/inprogress'));
    }
    

public function EditOA($id)
{
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model = new M_lelang();
            $user_id = session()->get('id_user');
            $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
            $logoData = $model->tampil('logo'); // Fetch all logos
            $filteredLogo = array_filter($logoData, function($item) {
                return $item->id_logo == 1; // Adjust this condition as needed
            });
            $data['satu'] = reset($filteredLogo);
        $where = array('id_transaksi' => $id);
       
        $data['sa'] = $model->joinThreeWhere(
            'transaksi',
            'menu',
            'minuman',
            'transaksi.id_menu = menu.id_menu',
            'transaksi.id_minuman = minuman.id_minuman',
            $where
        );
        print_r($sa);
        $model->logActivity($user_id, 'View', 'User view Edit Order.');
        // Get specific record for the given id
        $data['satus'] = $model->tampil('transaksi', 'id_transaksi', );
        $data['s'] = $model->tampil('menu', 'id_menu');
        $data['t'] = $model->tampil('minuman', 'id_minuman');
    
        echo view('header', $data);
        echo view('menu_L', );
        echo view('editOA', $data);
        echo view('footer_L');
            // print_r($data2);
    
        } else {
            return redirect()->to('home/notfound');
        }
    }

    public function aksi_EditOA()
    {
        $model = new M_lelang();
                $data['erwin'] = $model->getwhere('transaksi',$where);
        $Nomor = $data['erwin']->Nomor;
   
    
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('nama');
        $c = $this->request->getPost('Tanggal');
        $d = $this->request->getPost('jenis1');
        $e = $this->request->getPost('jenis2');
        $j = $this->request->getPost('totalM');
        $g = $this->request->getPost('totalMI');
        $id= $this->request->getPost('id');
        $totalHarga = $this->request->getPost('totalHarga');
        $where = array('id_transaksi' => $id);
                $isi = array(
                'user' => $a,
                'pending' => 'pending',
                'admin' => "petugas",
                'tanggal' => $c,
                'id_menu' => $d,
                'total_menu' => $j,    // Assuming 'id_menu' is the correct column name
                'id_minuman' => $e,
                'total_minuman' => $g, // Assuming 'id_minuman' is the correct column name
                'progress' => "inprogress",
                );
                
                print_r($isi);
                print_r($where);
                $model->logActivity($user_id, 'Updated', 'User Has Updated The transaction.');
                $model->edit('transaksi', $isi, $where);
            
        
//  Redirect to 'inprogress' page
        return redirect()->to(base_url('home/inprogress'));
       
    }
    public function Update()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('totalHarga');
        $id= $this->request->getPost('id');
        $isi = array('total_harga' => $a);
    
        // Condition for update
        $where = array('Nomor' => $id);
    
        // Call the edit function from the model
        $model->edit('transaksi', $isi, $where);
        $Nomor = $data['erwin']->Nomor;
       print_r($isi);
       print_r($where);
       $model->logActivity($user_id, 'Updated', 'User Has Updated The transaction.');
        return redirect()->to('Home/inprogress');
        // Redirect or do whatever you need after update
    } else {
        return redirect()->to('home/notfound');
    }
    }
public function history()
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
$data['sa'] = $model->joinThreeTables('transaksi',
'menu',
'minuman',
'transaksi.id_menu = menu.id_menu',
'transaksi.id_minuman = minuman.id_minuman', []);

$data['s'] = $model->tampil('menu', 'id_menu');
$data['t'] = $model->tampil('minuman', 'id_minuman');;
$model->logActivity($user_id, 'View', 'User view History.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('history',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function hapusO($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        // Step 1: Retrieve the record to get 'Nomor'
     
        $where= array('Nomor'=>$id);
        $model->logActivity($user_id, 'Cancel', 'User Has Cancel The transaction.');
        $model->hapus('transaksi',$where);
    

        // Redirect to 'inprogress' page
        return redirect()->to('home/inprogress');
    } else {
        return redirect()->to('home/notfound');
    }
}


public function hapusOA($id){
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model = new M_lelang();
    $user_id = session()->get('id_user');
    $where = array('id_transaksi'=>$id);
    $data['erwin'] = $model->getwhere('transaksi',$where);
        $Nomor = $data['erwin']->Nomor;
        $model->logActivity($user_id, 'Updated', 'User Has Updated The transaction.');
    $model->hapus('transaksi',$where);
    
    return redirect()->to('home/editO/'.$Nomor);
} else {
    return redirect()->to('home/notfound');
}
}


    public function SELESAI($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    // Data to be updated
    $isi = array('progress' => 'selesai');

    // Condition for update
    $where = array('Nomor' => $id);

    $model->logActivity($user_id, 'Finnish', 'User Has Completed The transaction.');
    $model->edit('transaksi', $isi, $where);
    return redirect()->to('Home/inprogress');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
public function history2()
{
    $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
$data['sa'] = $model->joinThreeTables('transaksi',
'menu',
'minuman',
'transaksi.id_menu = menu.id_menu',
'transaksi.id_minuman = minuman.id_minuman', []);

$data['s'] = $model->tampil('menu', 'id_menu');
$data['t'] = $model->tampil('minuman', 'id_minuman');;
$model->logActivity($user_id, 'View', 'User view History.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('history2',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function editO($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
    $where = array('Nomor' => $id);
    $data['te'] = $model->joinThreeWheregetResult(
        'transaksi',
        'menu',
        'minuman',
        'transaksi.id_menu = menu.id_menu',
        'transaksi.id_minuman = minuman.id_minuman',
        $where
    );
    $data['sa'] = $model->joinThreeWhere(
        'transaksi',
        'menu',
        'minuman',
        'transaksi.id_menu = menu.id_menu',
        'transaksi.id_minuman = minuman.id_minuman',
        $where
    );


    // Get specific record for the given id
    $data['satus'] = $model->tampil('transaksi', 'id_transaksi', );
    
    $data['s'] = $model->tampil('menu', 'id_menu');
    $data['t'] = $model->tampil('minuman', 'id_minuman');
    $model->logActivity($user_id, 'View', 'User view Edit Order.');
    echo view('header', $data);
    echo view('menu_L', );
    echo view('editO', $data);
    echo view('footer_L');
        // print_r($data2);

    } else {
        return redirect()->to('home/notfound');
    }
}


// public function aksi_confirm() {
//     // Load the model
//     $userLevel = session()->get('level');
//     $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

//     if (in_array($userLevel, $allowedLevels)) {
//     $model = new M_lelang();
//     $user_id = session()->get('id_user');

//     // Retrieve form data
//     $nama = $this->request->getPost('nama');
//     $tanggal = $this->request->getPost('Tanggal');
    
//     // Get the form data; ensure it's an array or initialize as an empty array
//     $jenis1 = $this->request->getPost('jenis1[]') ?? [];
//     $jenis2 = $this->request->getPost('jenis2[]') ?? [];


//     // Prepare data for insertion
  
//         $data[] = [
//             'user' => $nama,
//             'tanggal' => $tanggal,
//             'admin' => "petugas",
//             'id_menu' => $jenis1,
//             'id_minuman' => $jenis2,
//             'Selesai' => 'pending'
//         ];
//         $model->logActivity($user_id, 'Updated', 'User Has Updated The transaction.');
//         $model->tambah('transaksi', $data); // Pass the correct table name


//     // Redirect or return a response
//     return redirect()->to(base_url('home/editO/'.$nama)); // Adjust as needed
// } else {
//     return redirect()->to('home/notfound');
// }
// }

public function makan($id_menu = null)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin', 'Koki'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo');
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1;
        });
        $data['satu'] = reset($filteredLogo);
        $where = array('id_user' => session()->get('id_user'));
        $data['user'] = $model->getWhere('user', $where);

        // Pass id_menu to the view
        $data['id_menu'] = $id_menu;
        $data['s'] = $model->tampil('menu', 'id_menu');
        $data['t'] = $model->tampil('menu_backup', 'id_menu');
        $model->logActivity($user_id, 'View', 'User view Food Menu.');

        echo view('header', $data);
        echo view('menu_L', $data);
        echo view('makan', $data);
        echo view('footer_L');
    } else {
        return redirect()->to('home/notfound');
    }
}

    public function minum($id_minuman = null)
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $data['id_minuman'] = $id_minuman;
    $data['s'] = $model->tampil('minuman', 'id_minuman');
    $data['t'] = $model->tampil('minuman_backup', 'id_minuman');
    $model->logActivity($user_id, 'View', 'User view Drink Menu.');
    echo view('header', $data);
    echo view('menu_L',$data);
    echo view('minum',$data);
    echo view('footer_L');

} else {
    return redirect()->to('home/notfound');
}
    }
    public function Mdelete($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_menu' => $id);
        
            $model->logActivity($user_id, 'Menu', 'User Has Deleted a Menu.');
            $model->edit('menu', $isi, $where);
            $model->edit('menu_backup', $isi, $where);

            return redirect()->to('Home/makan');
            // Redirect or do whatever you need after update
        } else {
            return redirect()->to('home/notfound');
        }
        }
        public function Mrestore($id){
            $userLevel = session()->get('level');
            $allowedLevels = ['Manager', 'admin'];
        
            if (in_array($userLevel, $allowedLevels)) {
                $model= new M_lelang();
                $user_id = session()->get('id_user');
                // Data to be updated
                $isi = array('Soft' => 'Restore');
            
                // Condition for update
                $where = array('id_menu' => $id);
            
                $model->logActivity($user_id, 'Menu', 'User Has Restored a Menu.');
                $model->edit('menu', $isi, $where);
                $model->edit('menu_backup', $isi, $where);
    
                return redirect()->to('Home/RestoreM');
                // Redirect or do whatever you need after update
            } else {
                return redirect()->to('home/notfound');
            }
            }
            public function MIrestore($id){
                $userLevel = session()->get('level');
                $allowedLevels = ['Manager', 'admin'];
            
                if (in_array($userLevel, $allowedLevels)) {
                    $model= new M_lelang();
                    $user_id = session()->get('id_user');
                    // Data to be updated
                    $isi = array('Soft' => 'Restore');
                
                    // Condition for update
                    $where = array('id_minuman' => $id);
                
                    $model->logActivity($user_id, 'Menu', 'User Has Restored a Minuman.');
                    $model->edit('minuman', $isi, $where);
                     $model->edit('minuman_backup', $isi, $where);
                    return redirect()->to('Home/RestoreMI');
                    // Redirect or do whatever you need after update
                } else {
                    return redirect()->to('home/notfound');
                }
                }
    public function MIdelete($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_minuman' => $id);
        
            // Call the edit function from the model
            $model->logActivity($user_id, 'Drink', 'User Has Deleted a Drink.');
            $model->edit('minuman', $isi, $where);
            $model->edit('minuman_backup', $isi, $where);
            return redirect()->to('Home/minum');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function Medit($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_menu'=>$id);
$data['satu'] = $model->getwhere('menu', $where);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Food Menu Edit.');  
   echo view('header', $data);
echo view('menu_L',$data);
echo view('Medit', $data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
    }
    // public function aksi_Medit()
    // {
    //     $model = new M_lelang();
    //     $user_id = session()->get('id_user');
    //     $a = $this->request->getPost('nama');
    //     $b = $this->request->getPost('harga');
    //     $c = $this->request->getPost('stok');
    //     $Kategory = $this->request->getPost('Kategory');
    //     $id = $this->request->getPost('id');
    
    //     $backupWhere = ['id_menu' => $id];
    //     $existingBackup = $model->getWhere('menu_Backup', $backupWhere);
    
    //     if ($existingBackup) {
    //         $model->hapus('menu_Backup', $backupWhere);
    //     }
    
    //     $produkLama = $model->getProductById($id);
    //     $backupData = (array) $produkLama;
    
    //     $isi = array(
    //         'nama_menu' => $a,
    //         'Kategory' => $Kategory,
    //         'harga_menu' => $b,
    //         'Soft' => 'Restore',
    //         'stok' => $c
    //     );
    
    //     $model->logActivity($user_id, 'Menu', 'User Has Updated a Menu.');
    
    //     $where = array('id_menu' => $id);
    //     $model->edit('menu', $isi, $where);
    
    //     // Pass the id_menu to the makan method
    //     return redirect()->to('home/makan/' . $id);
    // }
    
    public function aksi_Medit()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang(); // Assuming you instantiate the model like this
        $user_id = session()->get('id_user');
        // Retrieve data from the POST request
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('harga');
        $c = $this->request->getPost('stok');
        $Kategory = $this->request->getPost('Kategory');
        $id = $this->request->getPost('id');
       
        // Define the where clause
        $where = array('id_menu' => $id);
    
        // Data to be updated
        $isi = array(
            'nama_menu' => $a,
            'Kategory' =>  $Kategory,
            'harga_menu' => $b,
            'Soft' => 'Restore',
            'stok' => $c
        );
    
        // Perform the update operation
        $model->logActivity($user_id, 'Menu', 'User Has Updated a Menu.');
        $model->edit('menu', $isi, $where);
    
        // Redirect to the desired page
        return redirect()->to('home/makan/' . $id);
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function RestoreEM()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang(); // Assuming you instantiate the model like this
        $user_id = session()->get('id_user');
        $d = $this->request->getPost('kode');
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('harga');
        $c = $this->request->getPost('stok');
        $Kategory = $this->request->getPost('Kategory');
        $id = $this->request->getPost('id');
       
        // Define the where clause
        $where = array('id_menu' => $id);
    
        // Data to be updated
        $isi = array(
            'Kode' => $d,
            'nama_menu' => $a,
            'Kategory' =>  $Kategory,
            'harga_menu' => $b,
            'Soft' => 'Restore',
            'stok' => $c
        );
    
        // Perform the update operation
        $model->logActivity($user_id, 'Menu', 'User Has Restore updated Menu.');
        $model->edit('menu', $isi, $where);
    
        print_r($isi);
        return redirect()->to('home/makan');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function RestoreEMI()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang(); // Assuming you instantiate the model like this
        $user_id = session()->get('id_user');
        $d = $this->request->getPost('kode');
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('harga');
        $c = $this->request->getPost('stok');
        $Kategory = $this->request->getPost('Kategory');
        $id = $this->request->getPost('id');
       
        // Define the where clause
        $where = array('id_minuman' => $id);
    
        // Data to be updated
        $isi = array(
            'Kode' => $d,
            'nama_minuman' => $a,
            'Kategory' =>  $Kategory,
            'harga_minuman' => $b,
            'Soft' => 'Restore',
            'stok' => $c
        );
    
        // Perform the update operation
        $model->logActivity($user_id, 'Drink', 'User Has Restore updated Drink.');
        $model->edit('minuman', $isi, $where);
    
        print_r($isi);
        return redirect()->to('Home/minum');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function t_makan()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
         $data['satu'] = reset($filteredLogo);
         $model->logActivity($user_id, 'View', 'User view Add Menu.');
            echo view('header', $data);
            echo view('menu_L');
              echo view('tmakan');
            echo view('footer_L');
    
} else {
    return redirect()->to('home/notfound');
}
    }
    public function aksi_t_menu()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang(); // Assuming you instantiate the model like this
        $user_id = session()->get('id_user');
        // Retrieve data from the POST request
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('harga');
        $c = $this->request->getPost('stok');
        $Kategory = $this->request->getPost('Kategory');
          // Get the current year
          $year = date('Y');
    
          // Get the count of current entries in the minuman table
          $count = $model->getMenuCount(); // Assuming you have a method to get the count
  
          // Increment the count to get the new sequence number
          $sequence = $count + 1;
  
          // Format the sequence number
          $nomor = sprintf('MI-%s-%03d', $year, $sequence);
  
          $isi = array(
              'Kode' => $nomor,
            'nama_menu' => $a,
            'Kategory' =>  $Kategory,
            'harga_menu' => $b,
            'Soft' => 'Restore',
            'stok' => $c
        );
    
        // Perform the update operation
        $model->logActivity($user_id, 'Menu', 'User Has Added a Food Menu.');
        $model->tambah('menu', $isi, $where);
        $model->tambah('menu_backup', $isi, $where);
    
        // Redirect to the desired page
        return redirect()->to('Home/makan');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function t_minum()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $data['satu'] = reset($filteredLogo);
         $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Add Menu Drink.');
            echo view('header', $data);
            echo view('menu_L');
              echo view('t_minum');
            echo view('footer_L');
        } else {
            return redirect()->to('home/notfound');
        }
    }
    public function aksi_t_minum()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model = new M_lelang(); // Assuming you instantiate the model like this
            $user_id = session()->get('id_user');
            // Retrieve data from the POST request
            $a = $this->request->getPost('nama');
            $b = $this->request->getPost('harga');
            $c = $this->request->getPost('stok');
            $Kategory = $this->request->getPost('Kategory');
    
            // Get the current year
            $year = date('Y');
    
            // Get the count of current entries in the minuman table
            $count = $model->getMinumanCount(); // Assuming you have a method to get the count
    
            // Increment the count to get the new sequence number
            $sequence = $count + 1;
    
            // Format the sequence number
            $nomor = sprintf('MI-%s-%03d', $year, $sequence);
    
            $isi = array(
                'Kode' => $nomor,
                'Kategory' => $Kategory,
                'nama_minuman' => $a,
                'harga_minuman' => $b,
                'stok' => $c,
                'Soft' => "Restore"
            );
    
            print_r($isi);
            $model->logActivity($user_id, 'Drink', 'User Has Added a Drink.');
            $model->tambah('minuman', $isi, $where);
            $model->tambah('minuman_backup', $isi, $where);
            // Redirect to the desired page
            return redirect()->to('Home/minum');
        } else {
            return redirect()->to('home/notfound');
        }
    }
    
    
    public function MIedit($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        $where=array('id_minuman'=>$id);
        $data['satus'] = $model->getwhere('minuman', $where);
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Edit Drink Menu.');
           echo view('header', $data);
        echo view('menu_L',$data);
        echo view('MIedit', $data);
        echo view('footer_L');
            
        } else {
            return redirect()->to('home/notfound');
        }
    }
            public function aksi_MIedit()
            {
                $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
                $model = new M_lelang(); // Assuming you instantiate the model like this
                $user_id = session()->get('id_user');
                // Retrieve data from the POST request
                $a = $this->request->getPost('nama');
                $b = $this->request->getPost('harga');
                $c = $this->request->getPost('stok');
                $Kategory = $this->request->getPost('Kategory');
                $id = $this->request->getPost('id');
               
                // Define the where clause
                $where = array('id_minuman' => $id);
            
                // Data to be updated
                $isi = array(
                    'Kategory' =>  $Kategory,
                    'nama_minuman' => $a,
                    'harga_minuman' => $b,
                    'stok' => $c
                );
            
                // Perform the update operation
                $model->logActivity($user_id, 'Drink', 'User Has Updated a Drink.');

                $model->edit('minuman', $isi, $where);
            
                // Redirect to the desired page
                return redirect()->to('home/minum/' . $id);
            } else {
                return redirect()->to('home/notfound');
            }
            }
            public function laporan()
    {
        $userLevel = session()->get('level');
        $allowedLevels = [ 'Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $data['satu'] = reset($filteredLogo);
         $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Reports Menu.');
            echo view('header', $data);
            echo view('menu_L', $data);
              echo view('laporan');
            echo view('footer_L');
        } else {
            return redirect()->to('home/notfound');
        }
    }
    public function print(){
        $userLevel = session()->get('level');
        $allowedLevels = [ 'Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
   $model= new M_lelang();
        $a= $this->request->getPost('DATE');
        $b= $this->request->getPost('DATE1');
        $data['print'] = $model->cari('transaksi','menu','minuman','transaksi.id_menu = menu.id_menu',
'transaksi.id_minuman = minuman.id_minuman',$a,$b);
    return view('print',$data);
} else {
    return redirect()->to('home/notfound');
}
}
 public function PDF(){
    $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
   $model= new M_lelang();
        $a= $this->request->getPost('DATE2');
        $b= $this->request->getPost('DATE3');
        $data['print'] = $model->cari('transaksi','menu','minuman','transaksi.id_menu = menu.id_menu',
        'transaksi.id_minuman = minuman.id_minuman',$a,$b);
    return view('PDF',$data);
} else {
    return redirect()->to('home/notfound');
}
}
public function Excel(){
    $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
   $model= new M_lelang();
        $a= $this->request->getPost('DATE4');
        $b= $this->request->getPost('DATE5');
        $data['print'] = $model->cari('transaksi','menu','minuman','transaksi.id_menu = menu.id_menu',
        'transaksi.id_minuman = minuman.id_minuman',$a,$b);
    return view('Excel',$data);
} else {
    return redirect()->to('home/notfound');
}
}
public function user()
{
    $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');
$model->logActivity($user_id, 'View', 'User view Worker Menu.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('User',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function admin()
{
    $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');
$model->logActivity($user_id, 'View', 'User view Admin Menu.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('admin',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function manager()
{
$model= new M_lelang();
$userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $user_id = session()->get('id_user');
$where=array('id_user'=>session()->get('id'));
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);

$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
$data['s'] = $model->tampil('user', 'id_user');
$model->logActivity($user_id, 'View', 'User view Manager Menu.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('manager',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function Koki()
{
$model= new M_lelang();
$userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $user_id = session()->get('id_user');
$where=array('id_user'=>session()->get('id'));
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);

$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
$data['s'] = $model->tampil('user', 'id_user');
$model->logActivity($user_id, 'View', 'User view Chef Menu.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('Koki',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function t_admin()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $data['satu'] = reset($filteredLogo);
         $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Add User.');
            echo view('header', $data);
            echo view('menu_L', $data);
              echo view('t_admin');
            echo view('footer_L');
        } else {
            return redirect()->to('home/notfound');
        }
    }
  
       public function aksi_t_admin()
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Manager', 'admin'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang(); // Assuming you instantiate the model like this
        $user_id = session()->get('id_user');
        // Retrieve data from the POST request
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('username');
        $c = $this->request->getPost('level');
        
        // Set password based on level
        if ($c == 'admin') {
            $password = md5("1137");
        } elseif ($c == 'Petugas') {
            $password = md5("137");
        } elseif ($c == 'Manager') {
            $password = md5("11137"); // Example password for manager
        } elseif ($c == 'Koki') {
            $password = md5("1237"); // Example password for manager
        } else {
            $password = md5("default137"); // Default password if level is not recognized
        }

        $isi = array(
            'nama_user' => $a,
            'username' => $b,
            'level' => $c,
            'password' => $password,
            'Email' => "0",
            'Nomor' => "0",
            'Soft' => "Restore",
            'foto' => "download.jpeg"
        );

        // Print the data for debugging purposes
        print_r($isi);

        // Perform the insert operation
        $model->logActivity($user_id, 'Drink', 'User Has Added a New User.');
        $model->tambah('user', $isi);

        // Redirect to the desired page
        return redirect()->to('Home/t_admin');
    } else {
        return redirect()->to('home/notfound');
    }
}

    
    public function Adelete($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_user' => $id);
        
            // Call the edit function from the model
            $model->logActivity($user_id, 'Admin', 'User Has Deleted An Admin.');
            $model->edit('user',$isi, $where);
        return redirect()->to('Home/admin');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function Pdelete($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_user' => $id);
        
            // Call the edit function from the model
            $model->logActivity($user_id, 'Worker', 'User Has Deleted A Worker.');
            $model->edit('user',$isi, $where);
        
        return redirect()->to('Home/user');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function MAdelete($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_user' => $id);
        
            // Call the edit function from the model
            $model->logActivity($user_id, 'Manager', 'User Has Deleted A Manager.');
            $model->edit('user',$isi, $where);
        
        return redirect()->to('Home/manager');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function MAdelete1($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            // Data to be updated
            $isi = array('Soft' => 'Deleted');
        
            // Condition for update
            $where = array('id_user' => $id);
        
            // Call the edit function from the model
            $model->logActivity($user_id, 'Chef', 'User Has Deleted A Chef.');
            $model->edit('user',$isi, $where);
        
        return redirect()->to('Home/Koki');
    } else {
        return redirect()->to('home/notfound');
    }
    }
    public function Reset1($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    // Data to be updated
    $isi = array('password' => md5('137'));

    // Condition for update
    $where = array('id_user' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Resetted an Account.');
    $model->edit('user', $isi, $where);
    return redirect()->to('Home/user');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
          
public function Reset2($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    // Data to be updated
    $isi = array('password' => md5('1137'));

    // Condition for update
    $where = array('id_user' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Resetted An Account');
    $model->edit('user', $isi, $where);
    return redirect()->to('Home/admin');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
public function Reset3($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    // Data to be updated
    $isi = array('password' => md5('11137'));

    // Condition for update
    $where = array('id_user' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Resetted An Account');
    $model->edit('user', $isi, $where);
    return redirect()->to('Home/manager');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
public function Reset4($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    // Data to be updated
    $isi = array('password' => md5('1237'));

    // Condition for update
    $where = array('id_user' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Resetted An Account');
    $model->edit('user', $isi, $where);
    return redirect()->to('Home/Koki');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}          
           public function setting()
           {
            $userLevel = session()->get('level');
            $allowedLevels = ['Manager', 'admin'];
        
            if (in_array($userLevel, $allowedLevels)) {
               $model = new M_lelang();
               $user_id = session()->get('id_user');
               $logoData = $model->tampil('logo'); // Fetch all logos
               $filteredLogo = array_filter($logoData, function($item) {
                   return $item->id_logo == 1; // Adjust this condition as needed
               });
               $data['satu'] = reset($filteredLogo);
               $where = array('id_logo' => $id);
               $data['sa'] = $model->getwhere('logo', $where);
               $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Setting.');
              
               echo view('header', $data);
               echo view('menu_L', $data);
               echo view('setting', $data);
               echo view('footer_L');
            } else {
                return redirect()->to('home/notfound');
            }
           }
     

           public function aksi_setting()
           {
               $model = new M_lelang();
               $user_id = session()->get('id_user');
               $a = $this->request->getPost('nama');
               $icon = $this->request->getFile('image2');
               $dash = $this->request->getFile('image');
               $banner1 = $this->request->getFile('image3');
               $banner2 = $this->request->getFile('image4');
           
               // Debugging: Log received data
               log_message('debug', 'Website Name: ' . $a);
               log_message('debug', 'Tab Icon: ' . ($icon ? $icon->getName() : 'None'));
               log_message('debug', 'Dashboard Icon: ' . ($dash ? $dash->getName() : 'None'));
               log_message('debug', 'banner1 Icon: ' . ($banner1 ? $banner1->getName() : 'None'));
               log_message('debug', 'banner2 Icon: ' . ($banner2 ? $banner2->getName() : 'None'));
           
               $data = ['nama_logo' => $a];
               $uploadPath = ROOTPATH . 'public/assets/img/custom/';
           
               if ($icon && $icon->isValid() && !$icon->hasMoved()) {
                   if (!file_exists($uploadPath . $icon->getName())) {
                       $icon->move($uploadPath, $icon->getName());
                   }
                   $data['icon'] = $icon->getName();
               }
           
               if ($dash && $dash->isValid() && !$dash->hasMoved()) {
                   if (!file_exists($uploadPath . $dash->getName())) {
                       $dash->move($uploadPath, $dash->getName());
                   }
                   $data['logos'] = $dash->getName();
               }
           
               if ($banner1 && $banner1->isValid() && !$banner1->hasMoved()) {
                   if (!file_exists($uploadPath . $banner1->getName())) {
                       $banner1->move($uploadPath, $banner1->getName());
                   }
                   $data['anima1'] = $banner1->getName();
               }
           
               if ($banner2 && $banner2->isValid() && !$banner2->hasMoved()) {
                   if (!file_exists($uploadPath . $banner2->getName())) {
                       $banner2->move($uploadPath, $banner2->getName());
                   }
                   $data['anima2'] = $banner2->getName();
               }
           
               $where = ['id_logo' => 1];
               $model->logActivity($user_id, 'Updated', 'User Has Updated The Logo');
               $model->edit('logo', $data, $where);
           
               return redirect()->to('home/setting/1');
           }
           

        //    public function aksi_setting()
        //    {
        //        $model = new M_lelang;
        //        $a = $this->request->getPost('nama');
        //        $id = $this->request->getPost('id');
               
        //        // Initialize the update data array with nama_Logo
        //        $isi = array('nama_Logo' => $a);
               
        //        // Handle 'image' file
        //        $uploadedFile = $this->request->getFile('image');
        //        if ($uploadedFile && !$uploadedFile->hasMoved()) {
        //            $photo = $uploadedFile->getName();
        //            if (!empty($photo)) {
        //                $isi['logos'] = $photo; // Add 'logos' to $isi if a valid file is uploaded
        //            }
        //        }
               
        //        // Handle 'image2' file
        //        $uploadedFile = $this->request->getFile('image2');
        //        if ($uploadedFile && !$uploadedFile->hasMoved()) {
        //            $photos = $uploadedFile->getName();
        //            if (!empty($photos)) {
        //                $isi['icon'] = $photos; // Add 'icon' to $isi if a valid file is uploaded
        //            }
        //        }
        //        $uploadedFile = $this->request->getFile('image3');
        //        if ($uploadedFile && !$uploadedFile->hasMoved()) {
        //            $photos = $uploadedFile->getName();
        //            if (!empty($photos)) {
        //                $isi['anima1'] = $photos; // Add 'icon' to $isi if a valid file is uploaded
        //            }
        //        }
        //        $uploadedFile = $this->request->getFile('image4');
        //        if ($uploadedFile && !$uploadedFile->hasMoved()) {
        //            $photos = $uploadedFile->getName();
        //            if (!empty($photos)) {
        //                $isi['anima2'] = $photos; // Add 'icon' to $isi if a valid file is uploaded
        //            }
        //        }
               
        //        // Define where clause
        //        $where = array('id_logo' => $id);
        //        print_r($isi);
        //        // Always perform update since nama_Logo should be updated
        //        $model->edit('logo', $isi, $where);
               
        //        return redirect()->to('Home/setting/1');
        //    }
           

           
           public function nota1($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();

        $where = array('Nomor' => $id);
        $data['te'] = $model->joinThreeWheregetResult(
            'transaksi',
            'menu',
            'minuman',
            'transaksi.id_menu = menu.id_menu',
            'transaksi.id_minuman = minuman.id_minuman',
            $where
        );

        $data['sa'] = $model->joinThreeWhere(
            'transaksi',
            'menu',
            'minuman',
            'transaksi.id_menu = menu.id_menu',
            'transaksi.id_minuman = minuman.id_minuman',
            $where
        );

        // Assuming you need the logo information as well, filtering by id_logo
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);

        echo view('nota1', $data);
    } else {
        return redirect()->to('home/notfound');
    }
}

           public function Bayar()
           {
               $userLevel = session()->get('level');
               $allowedLevels = ['1','Petugas', 'Manager', 'admin'];
           
               if (in_array($userLevel, $allowedLevels)) {
                   $model = new M_lelang();
                   $user_id = session()->get('id_user');
                   $d = $this->request->getPost('bayar');
                   $id = $this->request->getPost('id'); // Get the ID from the form
                   $where = array('Nomor' => $id);
                   // Data to be updated
                   $isi = array('pending' => 'Lunas', 'Total_bayar' => $d);
           
                   // Condition for update
                 
           
                   // Call the edit function from the model
                   $model->logActivity($user_id, 'Transaction', 'User Has Payed a Transaction');
                   $model->edit('transaksi', $isi, $where);
                   
                   // Debugging: Check if the update data and condition are correct
                   print_r($isi);
                   print_r($where);
           
                   // Uncomment to redirect after update
                   return redirect()->to('Home/history');
           
               } else {
                   return redirect()->to('home/notfound');
               }
           }
           
           public function BayarF($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['1','Petugas', 'Manager', 'admin'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        // Get all records from the transaksi table
        $transaksiData = $model->tampil('transaksi');
        
        // Filter the record based on the provided Nomor
        $filteredData = array_filter($transaksiData, function($item) use ($id) {
            return $item->Nomor == $id;
        });

        // Assuming there's only one record per Nomor
        $data['t'] = reset($filteredData);
        $model->logActivity($user_id, 'View', 'User view Payed Menu.');
        echo view('header', $data);
        echo view('menu_L', $data);
        echo view('BayarF', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/notfound');
    }
}
public function TambahEdit($id)
{
        $userLevel = session()->get('level');
        $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model = new M_lelang();
            $user_id = session()->get('id_user');
            $logoData = $model->tampil('logo'); // Fetch all logos
            $filteredLogo = array_filter($logoData, function($item) {
                return $item->id_logo == 1; // Adjust this condition as needed
            });
            $data['satu'] = reset($filteredLogo);
       
            $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
        $where = array('id_transaksi' => $id);
        $data['sa'] = $model->joinThreeWhere(
            'transaksi',
            'menu',
            'minuman',
            'transaksi.id_menu = menu.id_menu',
            'transaksi.id_minuman = minuman.id_minuman',
            $where
        );

        print_r($sa);
    
        // Get specific record for the given id
        $data['satus'] = $model->tampil('transaksi', 'id_transaksi', );
        $data['s'] = $model->tampil('menu', 'id_menu');
        $data['t'] = $model->tampil('minuman', 'id_minuman');
        $model->logActivity($user_id, 'View', 'User view Add Menu To Transaction.');
        echo view('header', $data);
        echo view('menu_L', );
        echo view('TambahEdit', $data);
        echo view('footer_L');
            // print_r($data2);
    
        } else {
            return redirect()->to('home/notfound');
        }
    }
    public function aksi_TambahEdit()
    {
        $model = new M_lelang();
                $data['erwin'] = $model->getwhere('transaksi',$where);
        $Nomor = $data['erwin']->Nomor;
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('nama');
        $ab = $this->request->getPost('nomor');
        $c = $this->request->getPost('Tanggal');
        $d = $this->request->getPost('jenis1');
        $e = $this->request->getPost('jenis2');
        $j = $this->request->getPost('totalM');
        $g = $this->request->getPost('totalMI');

        $where = array('id_transaksi' => $id);
                $isi = array(
                'Nomor' => $ab,
                'user' => $a,
                'pending' => 'pending',
                'admin' => "petugas",
                'tanggal' => $c,
                'id_menu' => $d,
                'total_menu' => $j,    // Assuming 'id_menu' is the correct column name
                'id_minuman' => $e,
                'total_minuman' => $g, // Assuming 'id_minuman' is the correct column name
                'progress' => "inprogress",
                );
                
                print_r($isi);
                $model->logActivity($user_id, 'Transaction', 'User Has Added Menu to transaction');
                $model->tambah('transaksi', $isi);
            
        
//  Redirect to 'inprogress' page
        return redirect()->to(base_url('home/inprogress'));
       
    }
    public function Profile ($id){
        $userLevel = session()->get('level');
        $allowedLevels = ['Manager', 'admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
 
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $model->logActivity($user_id, 'View', 'User view Profile.');
           echo view('header', $data);
        echo view('menu_L',$data);
        echo view('profile', $data);
        echo view('footer_L');
    } else {
        return redirect()->to('home/notfound');
    }
            }
            public function aksi_profile()
            {
                $model = new M_lelang();
                $user_id = session()->get('id_user');
                $a = $this->request->getPost('nama');
                $b = $this->request->getPost('nama2');
                $c = $this->request->getPost('level');
                $d = $this->request->getPost('email');
                $e = $this->request->getPost('nomor');
                $f = $this->request->getPost('pass');
                $g = $this->request->getPost('level');
                $id = $this->request->getPost('id');
                $profile = $this->request->getFile('image');
            
                // Debugging: Log received data
                log_message('debug', 'Website Name: ' . $a);
                log_message('debug', 'username    : ' . $b);
                log_message('debug', 'Jabatan     : ' . $c);
                log_message('debug', 'Email       : ' . $d);
                log_message('debug', 'Nomor       : ' . $e);
                log_message('debug', 'password    : ' . $f);
                log_message('debug', 'Profile     : ' . ($profile ? $profile->getName() : 'None'));
            
                $data = ['nama_user' => $a,
                         'username' => $b,
                         'level' => $c,
                         'Email' => $d,
                         'Nomor' => $e,
                         'level' => $g,
                         'password' => md5($f)];
                $uploadPath = ROOTPATH . 'public/assets/img/custom/';

                if ($profile && $profile->isValid() && !$profile->hasMoved()) {
                    if (!file_exists($uploadPath . $profile->getName())) {
                        $profile->move($uploadPath, $profile->getName());
                    }
                    $data['foto'] = $profile->getName();
                }
            
                $where = ['id_user' => $id];
                $model->logActivity($user_id, 'Profile', 'User Has Updated Their Account.');
                $model->edit('user', $data, $where);
            
                return redirect()->to('home/profile/'.session()->get('id_user'));
            }
        //     public function aksi_Profile()
        //    {
        //     $model = new M_lelang;
        //     $a = $this->request->getPost('nama');
        //     $b = $this->request->getPost('nama2');
        //     $c = $this->request->getPost('level');
        //     $d = $this->request->getPost('email');
        //     $e = $this->request->getPost('nomor');
        //     $f = $this->request->getPost('pass');
        //     $g = $this->request->getPost('level');
        //     $id = $this->request->getPost('id');
        //     $where = array('id_user' => $id);
        //     // Initialize the update data array with nama_Logo
        //     $isi = array(
        //         'nama_user' => $a,
        //         'username' => $b,
        //         'level' => $c,
        //         'Email' => $d,
        //         'Nomor' => $e,
        //         'level' => $g,
        //         'password' => md5($f),
        //     );
            
        //     // Handle 'image' file
        //     $uploadedFile = $this->request->getFile('image');
        //     if ($uploadedFile && !$uploadedFile->hasMoved()) {
        //         $photo = $uploadedFile->getName();
        //         if (!empty($photo)) {
        //             $isi['foto'] = $photo; // Add 'logos' to $isi if a valid file is uploaded
        //         }
        //     }
            
        //     // Define where clause
        
            
        //     // Always perform update since nama_Logo should be updated
        //     $model->edit('user', $isi, $where);
        //    print_r($isi); 
        //     return redirect()->to('Home/profile/'.session()->get('id_user'));
        //     }
            public function OrderK()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['Koki'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
    $data['sa'] = $model->joinThreeTables('transaksi',
    'menu',
    'minuman',
    'transaksi.id_menu = menu.id_menu',
    'transaksi.id_minuman = minuman.id_minuman', []);

    $data['s'] = $model->tampil('menu', 'id_menu');
    $data['t'] = $model->tampil('minuman', 'id_minuman');;
    $model->logActivity($user_id, 'View', 'User view Cheff Order Menu.');
    echo view('header', $data);
    echo view('menu_L',$data);
    echo view('OrderK',$data);
    echo view('footer_L');
    
} else {
    return redirect()->to('home/notfound');
}
}
public function SELESAI2($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('Selesai' => 'selesai');

    // Condition for update
    $where = array('Nomor' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Completed The Order.');
    $model->edit('transaksi', $isi, $where);
    return redirect()->to('Home/OrderK');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
public function Terima($id)
{
    $userLevel = session()->get('level');
    $allowedLevels = ['Petugas', 'Manager', 'admin','Koki'];

    if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');

    // Data to be updated
    $isi = array('Selesai' => 'inprogress');

    // Condition for update
    $where = array('Nomor' => $id);

    // Call the edit function from the model
    $model->logActivity($user_id, 'Reset', 'User Has Accepted The Order.');
    $model->edit('transaksi', $isi, $where);
    return redirect()->to('Home/OrderK');
    // Redirect or do whatever you need after update
} else {
    return redirect()->to('home/notfound');
}
}
public function activity_log()
{
    $userLevel = session()->get('level');
    $allowedLevels = ['admin'];

    if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
    
        $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
        $logs = $model->getActivityLogs();
        $data['s'] = $model->tampil('user', 'id_user');
        $data['logs'] = $logs;
        $model->logActivity($user_id, 'View', 'User view Activity Log.');
        echo view('header');
        echo view('menu_L', $data);
        return view('activity_log', $data);
    } else {
        return redirect()->to('http://localhost:8080/home/error_404');
    }
}
public function RestoreM()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);

    $data['s'] = $model->tampil('menu', 'id_menu');
    $model->logActivity($user_id, 'View', 'User view Restore Food Menu .');
    echo view('header', $data);
    echo view('menu_L',$data);
    echo view('RestoreM',$data);
    echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
    }
    public function RestoreMI()
    {
        $userLevel = session()->get('level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);

    $data['s'] = $model->tampil('minuman', 'id_minuman');
    $model->logActivity($user_id, 'View', 'User view Restore Drink Menu.');
    echo view('header', $data);
    echo view('menu_L',$data);
    echo view('RestoreMI',$data);
    echo view('footer_L');

} else {
    return redirect()->to('home/notfound');
}
    }
 
    public function RestoreUser()
{
    $userLevel = session()->get('level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');
$model->logActivity($user_id, 'View', 'User view user Restore Menu.');
 echo view('header', $data);
echo view('menu_L',$data);
echo view('RestoreUser',$data);
echo view('footer_L');
} else {
    return redirect()->to('home/notfound');
}
}
public function RestoreU($id){
    $userLevel = session()->get('level');
    $allowedLevels = ['Manager', 'admin'];

    if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        // Data to be updated
        $isi = array('Soft' => 'Restore');
    
        // Condition for update
        $where = array('id_user' => $id);
    
        // Call the edit function from the model
        $model->logActivity($user_id, 'Admin', 'User Has Restore A user.');
        $model->edit('user',$isi, $where);
    return redirect()->to('Home/RestoreUser');
} else {
    return redirect()->to('home/notfound');
}
}
}
