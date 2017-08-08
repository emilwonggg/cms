<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 2017/8/2
 * Time: 14:38
 */

namespace app\Http\Controllers\Home;

use App\Point;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use function Sodium\increment;

class UserController extends Controller
{
    public function __construct()
    {
        /*if (Auth::check()){
            redirect('user/center');
        }else {
            redirect('login');
        }*/
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password'=> $request->password])){

            return redirect('user/center');
        }
        return view('home.login');
    }
    public function center()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $game_id = 1;//默认为seekingdawnid
        $point = Point::where(['user_id'=>$user_id,'game_id'=>$game_id])->first();
        $friends = Point::where('from_referral_code',$point->referral_code)
            ->join('users', 'points.user_id', '=', 'users.id')
            ->get();
        return view('home.uc', compact('user','point','friends'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')){
            $this->validate($request, [
                'email' => 'required|unique:users',
                'username' => 'required|max:50',
                'password' => 'required|max:30|min:6'
            ]);
            $User = new User;
            $User->name = $request->username;
            $User->password = bcrypt($request->password);
            $User->email = $request->email;
            $User->save();
            $Point = new Point;
            $Point->user_id = $User->id;
            $from_referral_id = Point::where('referral_code', $request->referral_code)->value('user_id');
            $Point->from_referral_code = $request->referral_code;//提交的推荐码
            $Point->from_referral_id = $from_referral_id;//提交的推荐人ID
            if ($from_referral_id!== ''){
                Point::where('referral_code',$request->referral_code)->increment('points', 5);
            }
            $Point->referral_code = $this->referralCode(1);//生成的自己的推荐码数
            $Point->game_id = '1';//默认seekingdawn为1
            $Point->points = 10;//默认seekingdawn为1
            $Point->points_level = 1;//初始等级为1
            $Point->save();
            return redirect('login');
        }
        if ($request->isMethod('get')){
            $code = $request->code;
            return view('home.register', compact('code'));
        }
    }
    /*
     * @param int $no_of_codes//定义一个int类型的参数 用来确定生成多少个优惠码
     * @param array $exclude_codes_array//定义一个exclude_codes_array类型的数组
     * @param init $code_length //定义一个code_length的参数来确定优惠码的长度
     * @return array//返回数组
     * */
    public function referralCode($no_of_codes, $exclude_codes_array='', $code_length = 6)
    {
        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $promotion_codes = array();//这个数组用来接收生成的优惠码
        for ($j = 0; $j < $no_of_codes; $j++){
            $code = "";
            for ($i = 0; $i < $code_length; $i++){
                $code .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
            //如果生成的6位随机数不在我们定义的$promotion_codes函数里
            if (!in_array($code, $promotion_codes)){
                if (is_array($exclude_codes_array)){
                    if (!in_array($code, $exclude_codes_array)){//排除已经使用的优惠码数
                        $promotion_codes[$j] = $code;//将新生成的优惠码赋值给promotion_codes数组
                    }else{
                        $j--;
                    }
                }else {
                    $promotion_codes[$j] = $code;//将优惠码赋值给数组
                }
            }else{
                $j--;
            }
        }
        if ($no_of_codes = 1){
            $promotion_codes = $promotion_codes[0];
        }
        return $promotion_codes;
    }

    public function ambassador()
    {
        $user = Auth::user();
        if ($user === ''){
            $user = null;
        }
        $points = Point::where([])->orderBy('points','desc')->take(10)
            ->join('users', 'points.user_id', '=', 'users.id')
            ->get();
        return view('home.ambassador', compact('points','user'));
    }
    public function ambassadorCode($code)
    {
        if ($code){
            $user = Auth::user();
            if ($user === ''){
                $user = null;
            }
            $points = Point::where([])->orderBy('points','desc')->take(10)
                ->join('users', 'points.user_id', '=', 'users.id')
                ->get();
            $point = Point::where('referral_code', $code)->first();
            if ($point !== '') {
                echo $point;
            }
        }
            return view('home.ambassador', compact('points','user','code'));
    }
    /*
     * @param init $points
     * return int
     * */
    public function tier($param)
    {
        if ($param<100) {
            return 'Tier 1';
        } else if($param<200){
            return 'Tier 2';
        } else if($param<300){
            return 'Tier 3';
        } else if($param<400){
            return 'Tier 4';
        } else if($param<500){
            return 'Tier 5';
        } else if($param<700){
            return 'Tier 6';
        } else if($param<900){
            return 'Tier 7';
        } else{
            return 'Tier 9';
        }
    }
}