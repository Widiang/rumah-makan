<?php 

namespace App\Models;
use CodeIgniter\Model;
class M_lelang extends Model
{
	public function tampil($table){
		
		return $this->db
					->table($table)
					->get()
					->getResult();

	}
	public function tambah($table, $isi){
		return$this->db->table($table)
						->insert($isi);
	}
	public function hapus($table, $where){
		return $this->db->table($table)
						->delete($where);
						
	}
		public function edit($table, $isi, $where){
		return $this->db->table($table)
						->update($isi, $where);
		}
		public function getWhere($table,$where){
			return $this->db->table($table)
							->getWhere($where)
							->getRow();

		}
		public function join($table, $table2, $on){
			return $this->db->table($table)
							->join($table2,$on,'left')
							->get()
							->getResult();
							}
	public function joinWhere($table, $table2, $on, $where) {
    $result = $this->db->table($table)
                       ->join($table2, $on, 'left')
                       ->getWhere($where)
                       ->getRow();

}
	public function joinWheregetResult($table, $table2, $on, $where) {
    $result = $this->db->table($table)
                       ->join($table2, $on)
                       ->getWhere($where)
                       ->getResult();

}
public function joinThreeWhere($tabel, $tabel2, $tabel3, $on, $on2, $where){
        return $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->getWhere($where)
                        ->getRow();
    
    }
    public function joinThreeWhereM($tabel, $tabel2, $tabel3, $on, $on2, $where){
    return $this->db->table($tabel)
                    ->join($tabel2, $on, 'left')
                    ->join($tabel3, $on2, 'left')
                    ->getWhere($where)
                    ->getResult(); // Use getResult() to retrieve multiple rows
}


    public function joinThreeTables($tabel, $tabel2, $tabel3, $on1, $on2){
        return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->get()
        ->getResult();
			}	
	 public function joinFourTable($tabel, $tabel2, $tabel3,$tabel4, $on1, $on2,$on3){
        return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->join($tabel4, $on3, 'left')
        ->get()
        ->getResult();
			}	

	 public function joinFourWhere($tabel, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $where)
{
    return $this->db->table($tabel)
        ->join($tabel2, $on1, 'left')
        ->join($tabel3, $on2, 'left')
        ->join($tabel4, $on3, 'left')
        ->getWhere($where) // Condition should be passed as the second parameter
        ->getRow();
}
public function getMinumanCount()
    {
        return $this->db->table('minuman')->countAllResults();
    }
    public function getMenuCount()
    {
        return $this->db->table('menu')->countAllResults();
    }

		public function upload($photo)
		{
    		$imageName = $photo->getName();
    		$photo->move(ROOTPATH . 'public/img/assets/img/custom', $imageName);
}				
public function cari($table, $table2,$tabel3, $on,$on2, $awal, $akhir){
			return $this->db->table($table)
							->join($table2,$on,'left')
                            ->join($tabel3, $on2, 'left')
							->getWhere("tanggal BETWEEN '$awal' AND '$akhir'")
							->getResult();
}
public function cari1($table, $awal, $akhir){
			return $this->db->table($table)
							->getWhere("tanggal BETWEEN '$awal' AND '$akhir'")
							->getResult();
}

    public function getProdukPrice($produk)
{
    $query = $this->db->table('produk')
                      ->select('harga')
                      ->where('id_produk', $produk)
                      ->get();
    
    $row = $query->getRow();

    if ($row) {
        return $row->harga;
    } else {
        // If product not found, return 0 or handle the situation as needed
        // For now, let's return 0
        return 0;
    }
}
public function getLatestNomor($year)
{
    // Query to get the latest Nomor for the current year
    $builder = $this->db->table('transaksi');
    $builder->select('Nomor');
    $builder->like('Nomor', 'NO-' . $year . '-', 'after');
    $builder->orderBy('Nomor', 'DESC');
    $query = $builder->get();
    
    $result = $query->getRow();
    return $result ? $result->Nomor : null;
}
public function joinThreeWheregetResult($tabel, $tabel2, $tabel3, $on, $on2, $where){
    return $this->db->table($tabel)
                    ->join($tabel2, $on)
                    ->join($tabel3, $on2)
                    ->getWhere($where)
                    ->getResult();

}
public function joinFourWheregetResult($tabel, $tabel2, $tabel3, $tabel4, $on1, $on2, $on3, $where){
    return $this->db->table($tabel)
                ->join($tabel2, $on1, 'left')
                ->join($tabel3, $on2, 'left')
                ->join($tabel4, $on3, 'left')
                    ->getWhere($where)
                    ->getResult();

}
public function logActivity($user_id, $activity, $description) {
    date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB
    $timestamp = date('Y-m-d H:i:s'); // Waktu dalam WIB

    $data = [
        'user_id' => $user_id,
        'activity' => $activity,
        'description' => $description,
        'timestamp' => $timestamp, // Tambahkan timestamp ke data
    ];

    $this->db->table('activity_log')->insert($data);
}


public function getActivityLogs() {
    try {
        $query = $this->db->table('activity_log')
                          ->join('user', 'activity_log.user_id = user.id_user', 'left')
                          ->select('user.username, activity_log.activity, activity_log.description, activity_log.timestamp')
                          ->orderBy('activity_log.timestamp', 'DESC')
                          ->get();

        if ($query === false) {
            // Log the last error and the query
            log_message('error', 'Query error: ' . $this->db->error()['message']);
            log_message('error', 'Last query: ' . $this->db->getLastQuery());
            return [];
        }

        return $query->getResultArray();
    } catch (\Exception $e) {
        // Log the error or handle it as necessary
        log_message('error', 'Error fetching activity logs: ' . $e->getMessage());
        return [];
    }
}
public function getProductById($id)
{
    return $this->db->table('menu')->where('id_menu', $id)->get()->getRow();
}

public function getMinumById($id)
{
    return $this->db->table('minuman')->where('id_minuman', $id)->get()->getRow();
}
public function getUserById($id)
{
    return $this->db->table('user')->where('id_user', $id)->get()->getRow();
}

}
