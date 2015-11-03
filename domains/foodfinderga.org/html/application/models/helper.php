<?php

class Helper extends CI_Model
{
    function _construct()
    {
        // Call the Model constructor
        parent::_construct();
    }

    // Get user info begins
    function check_user($email, $password)
    {
        if ($email == '' || $password == "")
            return false;
        $r = mysql_query("SELECT * FROM rk_admin WHERE email='{$email}' and password='{$password}'");
        if (mysql_num_rows($r) == 0)
            return false;
        return mysql_fetch_assoc($r);
    }

    function addtrainer($arr_data)
    {
        $data = $arr_data;
        unset($data['submit']);
        $name = $data['name'];
        $r = mysql_query("SELECT * FROM rk_trainer WHERE name='$name'");
        if (mysql_num_rows($r) == 0):
            $insert = array('name' => $data['name'], 'department' => $data['department'], 'description' => $data['description']);
            $this->db->insert('rk_trainer', $insert);

            return $this->db->insert_id();
        else:
            return false;
        endif;
    }


    function addgroup($arr_data)
    {

        $trainer = $arr_data['trainers'];
        $data = $arr_data;
        unset($data['submit']);
        $group_name = $data['groupname'];
        $r = mysql_query("SELECT * FROM rk_group WHERE groupname='$group_name'");
        if (mysql_num_rows($r) == 0) {
            $insert = array('groupname' => $data['groupname'], 'description' => $data['description'],);
            $this->db->insert('rk_group', $insert);
            $gid = $this->db->insert_id();
            for ($i = 0; $i < sizeof($trainer); $i++) {
                $assign = array('group_id' => $gid, 'trainer_id' => $trainer[$i]);
                $this->db->insert('rk_assign_trainer', $assign);
            }

            return TRUE;
        } else {
            return false;
        }

    }

    function show_trainer()
    {
        $results = mysql_query("Select * from rk_trainer");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function show_group()
    {
        $results = mysql_query("SELECT gid, groupname FROM rk_group where deletestatus!='1'");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $gid = $row['gid'];

            $row['noofproducts'] = array();
            $row2 = mysql_num_rows(mysql_query("SELECT * FROM rk_product_group where gid='$gid'"));
            $row['noofproducts'] = $row2;

            $results1 = mysql_query("SELECT name FROM rk_assign_trainer rat LEFT JOIN rk_trainer rt on rat.trainer_id=rt.trid where group_id='$gid'");
            $row['trainers'] = array();
            while ($row1 = mysql_fetch_assoc($results1)):
                $row['trainers'][] = $row1['name'];
            endwhile;
            $list[] = $row;

        endwhile;
        return $list;
    }

    function showspecificgroup($data)
    {
        $search = "";
        $groupsearch = "";
        if (isset($data['group'])) {
            $group = $data['group'];
            for ($i = 0; $i < count($group); $i++) {
                $groupsearch .= "'" . $group[$i] . "'";
                $totalcount = count($group) - 1;
                if ($i < $totalcount) {
                    $groupsearch .= ',';
                }
            }
            $search .= " where gid IN ($groupsearch)";
        }
        $results = mysql_query("SELECT * FROM rk_group$search");
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    function getproductcount($group_name)
    {
        $group_name = $group_name;
        $r = mysql_query("SELECT p.product_id FROM rk_product p, rk_group g where p.group=g.gid and g.groupname='$group_name'");
        $totalcount = mysql_num_rows($r);
        return $totalcount;
    }

    function trainerList()
    {
        $query = "SELECT trid, name from rk_trainer where trid not in(SELECT trainer_id from rk_assign_trainer)";
        $results = mysql_query($query);
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;
    }

    // Load Group List
    public function load_single_group($id)
    {
        $query = $this->db->get_where('rk_group', array('gid' => $id));
        $list = array();
        foreach ($query->result() as $row) {
            $list[] = $row;
        }
        return $list;
    }

    function trainer_delete($trainer_id)
    {
        $this->db->delete('rk_trainer', array('trid' => $trainer_id));
        if (($this->db->affected_rows()) > 0) {
            $this->db->delete('rk_assign_trainer', array('trainer_id' => $trainer_id));
        }
    }

    // Load Group Trainer
    public function load_single_grouptrainer($id)
    {
        $this->db->select('*');
        $this->db->from('rk_assign_trainer');
        $this->db->join('rk_trainer', 'rk_assign_trainer.trainer_id = rk_trainer.trid', 'left');
        $this->db->where('rk_assign_trainer.group_id', $id);
        $query = $this->db->get();
        //$query = $this->db->get_where('rk_product_group', array('product_id' => $id));
        $list = array();
        foreach ($query->result() as $row) {
            $list[] = $row;
        }
        return $list;
    }

    //update product
    public function update_group($id, $data)
    {
        $groupname = $data['groupname'];
        $r = mysql_query("SELECT * FROM rk_group WHERE groupname='$groupname' and gid='$id'");
        if (mysql_num_rows($r) != 0) {
            $insert = array('groupname' => $data['groupname'], 'description' => $data['description']);
            $res = $this->db->update('rk_group', $insert, "gid = '{$id}'");
            $this->db->delete('rk_assign_trainer', array('group_id' => $id));
            foreach ($data['trainers'] as $gid) {
                $insertgroup = array('group_id' => $id, 'trainer_id' => $gid);
                $this->db->insert('rk_assign_trainer', $insertgroup);
            }
            return true;
        } else {
            $row = mysql_query("SELECT * FROM rk_group WHERE groupname='$groupname'");
            if (mysql_num_rows($row) != 0) {
            } else {
                $insert = array('groupname' => $data['groupname'], 'description' => $data['description']);
                $res = $this->db->update('rk_group', $insert, "gid = '{$id}'");
                $this->db->delete('rk_assign_trainer', array('group_id' => $id));
                foreach ($data['trainers'] as $gid) {
                    $insertgroup = array('group_id' => $id, 'trainer_id' => $gid);
                    $this->db->insert('rk_assign_trainer', $insertgroup);
                }
                return true;
            }
            return false;
        }
    }

    // load single trainer
    public function load_single_trainer($id)
    {
        $query = $this->db->get_where('rk_trainer', array('trid' => $id));
        $list = array();
        foreach ($query->result() as $row) {
            $list[] = $row;
        }
        return $list;
    }

    //update trainer
    public function update_trainer($id, $data)
    {
        $name = $data['name'];
        $r = mysql_query("SELECT * FROM rk_trainer WHERE name='$name' and trid='$id'");
        if (mysql_num_rows($r) != 0) {
            $insert = array('name' => $data['name'], 'department' => $data['department'], 'description' => $data['description']);
            $res = $this->db->update('rk_trainer', $insert, "trid = '{$id}'");
            return true;
        } else {
            $row = mysql_query("SELECT * FROM rk_trainer WHERE name='$name'");
            if (mysql_num_rows($row) != 0) {
            } else {
                $insert = array('name' => $data['name'], 'department' => $data['department'], 'description' => $data['description']);
                $res = $this->db->update('rk_trainer', $insert, "trid = '{$id}'");
                return true;
            }
            return false;
        }
    }

    public function trainer_search($data)
    {
        $search = "";
        $name = $data['name'];
        if ($name != '') {
            $search .= " and name LIKE '%" . $name . "%'";
        }
        $query = "SELECT * from rk_trainer where deletestatus!='1'$search order by name ASC";
        $results = mysql_query($query);
        $list = array();
        while ($row = mysql_fetch_assoc($results)):
            $list[] = $row;
        endwhile;
        return $list;

    }

    public function totalproduct()
    {
        $this->db->where('deletestatus', 0);
        $totalproduct = $this->db->count_all_results('rk_product');
        return $totalproduct;
    }

    public function totalgroup()
    {
        $totalgroup = $this->db->count_all_results('rk_group');
        return $totalgroup;
    }

    public function totaltrainers()
    {
        $this->db->where('deletestatus', 0);
        $totaltrainer = $this->db->count_all_results('rk_trainer');
        return $totaltrainer;
    }

}

?>