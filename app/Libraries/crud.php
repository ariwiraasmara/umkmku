<?php
namespace App\Mylibs;

use App\Models\User;
use App\Http\Requests\Storeuser;
use App\Http\Requests\Updateuser;

use App\Models\asmcp_1000_user;
use App\Http\Requests\Storeasmcp_1000_userRequest;
use App\Http\Requests\Updateasmcp_1000_userRequest;

use App\Models\asmcp_1001_userid;
use App\Http\Requests\Storeasmcp_1001_useridRequest;
use App\Http\Requests\Updateasmcp_1001_useridRequest;

use App\Models\asmcp_1002_userdir;
use App\Http\Requests\Storeasmcp_1002_userdirRequest;
use App\Http\Requests\Updateasmcp_1002_userdirRequest;

use App\Models\asmcp_1003_usersecurity;
use App\Http\Requests\Storeasmcp_1003_usersecurityRequest;
use App\Http\Requests\Updateasmcp_1003_usersecurityRequest;

use App\Models\asmcp_1004_userfolders;
use App\Http\Requests\Storeasmcp_1004_userfoldersRequest;
use App\Http\Requests\Updateasmcp_1004_userfoldersRequest;

use App\Models\asmcp_1005_userplaylists;
use App\Http\Requests\Storeasmcp_1005_userplaylistsRequest;
use App\Http\Requests\Updateasmcp_1005_userplaylistsRequest;

use App\Models\asmcp_1006_userfiles;
use App\Http\Requests\Storeasmcp_1006_userfilesRequest;
use App\Http\Requests\Updateasmcp_1006_userfilesRequest;

use App\Models\asmcp_1007_usersetting;
use App\Http\Requests\Storeasmcp_1007_usersettingRequest;
use App\Http\Requests\Updateasmcp_1007_usersettingRequest;

use App\Models\asmcp_1009_userstoragelevel;
use App\Http\Requests\Storeasmcp_1009_userstoragelevelRequest;
use App\Http\Requests\Updateasmcp_1009_userstoragelevelRequest;

use App\MyLibs\myfunction;

class crud {

    public function __construct() {

    }

    // users procedure
    public static function puser(int $type = 0, array $val) {
        if($type == 1) { // insert
            User::create([
                'username'          => $val['username'],
                'email'             => $val['email'],
                'tlp'               => $val['tlp'],
                'password'          => $val['password'],
                'remember_token'    => $val['token'],
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'        => date('Y-m-d H:i:s')
            ]);
        }
        else if($type == 2) { // update password
            User::where('id', '=', $val['id'])->update([
                'password'  => $val['password'],
                'update_at' => date('Y-m-d H:i:s')
            ]);
        }
        else if($type == 3) { // update tlp
            User::where('id', '=', $val['id'])->update([
                'tlp'       => $val['tlp'],
                'update_at' => date('Y-m-d H:i:s')
            ]);
        }
        else if($type == 4) { // soft delete
            User::where($val)->update([
                'deleted_at'  => date('Y-m-d H:i:s')
            ]);
        }
        else if($type == 5) { // hard delete
            User::where($val)->delete();
        }
    }

    // asmcp_1000_user Procedure
    public static function p1000(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1000_user::create([
                'username'          => $val['username'],
                'email'             => $val['email'],
                'password'          => $val['password'],
                'remember_token'    => $val['token'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1000_user::where('id', '=', $val['id'])->update([
                "tlp"       => $val['tlp'],
                "pin"       => $val['pin'],
            ]);
        }
        else if($type == 4) { // hard delete
            asmcp_1000_user::where($val)->delete();
        }
    }

    // asmcp_1001_userid procedure
    public static function p1001(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1001_userid::create([
                "id_1001"   => $val['id1001'],
                "id"        => $val['id'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1001_userid::where('id_1001', '=', $val['id1001'])->update([
                "nama"          => $val['nama'],
                "tempat_lahir"  => $val['tempat_lahir'],
                "tgl_lahir"     => $val['tgl_lahir'],
                "alamat"        => $val['alamat'],
            ]);
        }
        else if($type == 3) { // hard delete
            asmcp_1001_userid::where($val)->delete();
        }
    }

    // asmcp_1000_user & asmcp_1001_userid update procedure
    public static function updateuser(string $id = null, string $field = null, $val = null) {
        return asmcp_1000_user::join('asmcp_1001_userid', 'asmcp_1001_userid.id', '=', 'asmcp_1000_user.id')
                         ->where('asmcp_1001_userid.id_1001', '=', $id)->update([
            $field => $val,
        ]);
        // return $id;

        // if($type = 1000) {
        //     asmcp_1000_user::where('id', '=', $id)->update([
        //         $field => $val,
        //     ]);
        // }
        // else if($type == 1001) {
        //     asmcp_1001_userid::where('id_1001', '=', $id)->update([
        //         $field => $val,
        //     ]);
        // }
    }

    // asmcp_1002_userdir procedure
    public static function p1002(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1002_userdir::create([
                "id_1002" => $val['id1002'],
                "id_1001" => $val['id1001'],
                "rootdir" => $val['rootdir'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1002_userdir::where('id_1001', '=', $val['id1001'])->update([
                "rootdir" => $val['rootdir'],
            ]);
        }
    }

    // asmcp_1003_usersecurity procedure
    public static function p1003(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1003_usersecurity::create([
                "id_1003"       => $val['id1003'],
                "id_1001"       => $val['id1001'],
            ]);
        }
        else if($type == 2) { // update device 1
            asmcp_1003_usersecurity::where('id_1001', '=', $val['id1001'])->update([
                "device1"       => $val['device1'],
                "device_type1"  => $val['device_type1'],
                "device_os1"    => $val['device_os1'],
            ]);
        }
        else if($type == 2) { // update device 2
            asmcp_1003_usersecurity::where('id_1003', '=', $val['id1003'])->update([
                "device2"       => $val['device2'],
                "device_type2"  => $val['device_type2'],
                "device_os2"    => $val['device_os2'],
            ]);
        }
        else if($type == 4) { // hard delete
            asmcp_1003_usersecurity::where($val)->delete();
        }
    }

    // asmcp_1004_userfolder procedure
    public static function p1004(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1004_userfolders::create([
                "id_1004"    => $val['id1004'],
                "id_1001"    => $val['id1001'],
                "foldername" => $val['foldername'],
                "ket"        => $val['ket'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1004_userfolders::where('id_1004', '=', $val['id1004'])->update([
                "foldername" => $val['foldername'],
                "ket"        => $val['ket'],
            ]);
        }
        else if($type == 4) { // hard delete
            asmcp_1004_userfolders::where($val)->delete();
        }
    }

    // asmcp_1005_userplaylist procedure
    public static function p1005(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1005_userplaylists::create([
                "id_1005"  => $val['id1005'],
                "id_1001"  => $val['id1001'],
                "playlist" => $val['playlist'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1005_userplaylists::where('id_1006', '=', $val['id1006'])->update([
                "playlist" => $val['playlist'],
            ]);
        }
        else if($type == 4) { // hard delete
            asmcp_1005_userplaylists::where($val)->delete();
        }
    }

    // asmcp_1006_userfile procedure
    public static function p1006(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1006_userfiles::create([
                "id_1006"   => $val['id1006'],
                "id_1001"   => $val['id1001'],
                "filename"  => $val['filename'],
                // "genre"     => $val['genre'],
                // "artist"    => $val['artist'],
                // "album"     => $val['album'],
                // "composer"  => $val['composer'],
                // "publisher" => $val['publisher'],
                // "ket"       => $val['ket'],
                // "favorited" => $val['favorited'],
                // "folder"    => $val['folder'],
                // "playlist"  => $val['playlist'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1006_userfiles::where('id_1006', '=', $val['id1006'])->update([
                // "filename"  => $val['filename'],
                "genre"     => $val['genre'],
                "artist"    => $val['artist'],
                "album"     => $val['album'],
                "composer"  => $val['composer'],
                "publisher" => $val['publisher'],
                "ket"       => $val['ket'],
                "favorited" => $val['favorited'],
                // "folder"    => $val['folder'],
                // "playlist"  => $val['playlist'],
            ]);
        }
        else if($type == 3) { // delete folder
            asmcp_1006_userfiles::where($val)->delete();
        }
    }

    public static function movefile(string $field = null, array $val) {
        asmcp_1006_userfiles::where('id_1006', '=', $val['id1006'])->update([
            $field => $val['fv'],
        ]);
    }

    // asmcp_1007_usersetting procedure
    public static function p1007(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1007_usersetting::create([
                "id_1007"           => $val['id1007'],
                "id_1001"           => $val['id1001'],
                "theme"             => $val['theme'],
                "text"              => $val['text'],
            ]);
        }
        else if($type == 2) { // update
            asmcp_1007_usersetting::where('id_1001', '=', $val['id'])->update([
                "theme"             => $val['theme'],
                "text"              => $val['text'],
                "bar"               => $val['bar'],
                "wall_img"          => $val['wall_img'],
                "wall_height"       => $val['wall_height'],
                "wall_width"        => $val['wall_width'],
                "wall_size"         => $val['wall_size'],
                "wall_position"     => $val['wall_position'],
                "wall_repeat"       => $val['wall_repeat'],
                "wall_attachment"   => $val['wall_attachment'],
            ]);
        }
        else if($type == 4) { // hard delete
            asmcp_1007_usersetting::where($val)->delete();
        }
    }

    // asmcp_1009_userstoragelevel procedure
    public static function p1009(int $type = 0, array $val) {
        if($type == 1) { // insert
            asmcp_1009_userstoragelevel::create([
                "id_1009"   => $val['id1009'],
                "id_1001"   => $val['id1001'],
                "level"     => $val['level'],
            ]);
        }
        else if($type == 2) { // hard delete
            asmcp_1009_userstoragelevel::where($val)->delete();
        }
        else if($type == 3) { // update level 2
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl2_at",
            ]);
        }
        else if($type == 4) { // update level 3
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl3_at",
            ]);
        }
        else if($type == 5) { // update level 4
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl4_at",
            ]);
        }
        else if($type == 6) { // update level 5
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl5_at",
            ]);
        }
        else if($type == 7) { // update level 6
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl6_at",
            ]);
        }
        else if($type == 8) { // update level 7
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl7_at",
            ]);
        }
        else if($type == 9) { // update level 8
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl8_at",
            ]);
        }
        else if($type == 10) { // update level 9
            asmcp_1009_userstoragelevel::where('id_1001', '=', $val['id1001'])->update([
                "upgraded_lvl9_at",
            ]);
        }
    }
}
?>
