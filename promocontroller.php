<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use foo\bar;
use Hash;
use SEO;
use App\Models\Transaction;
use App\Models\User;
use Validator;
use Carbon\Carbon;

class PromoController extends Controller
{

    public function show()
    {
        SEO::opengraph()->setUrl(env('APP_URL'));
        if (!Auth::check()) {
            return back()->withErrors('Необходимо авторизоваться, перед открытием личного кабинета!');
        }
        $user = Auth::user();
        
        return view('Cabinet.promo', ['user' => $user]);
    }
    public function activation(Request $request) {
        if (!Auth::check()) {
            return back()->withErrors('Необходимо авторизоваться, перед активацией промокода!');
        }
        $validator = Validator::make($request->all(), [
            'promo' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Auth::user();
        $promo = DB::table('promocode')->Where('promoCode', $request->input('promo'))->first();
        $audit = DB::table('promocode_audit')->Where('activate_userID', $user->id)->first();
        $userGame = DB::connection('ddtank')->table('Sys_Users_Detail')->where('UserName', $user->name)->select('UserID', 'NickName', 'State')->get()->first();

        if($userGame->State == 1)
            return back()->withErrors("Необходимо выйти с игры прежде чем переводить валюту!");

        if (!$promo) {
            return back()->withErrors('Промо не найдено.');
        } else {
            if ($promo->promoCount > 0) {
                if ($audit == $user->id) {
                    return back()->withErrors('Вы уже активировали этот промокод.');
                } else {
                    $slot1 = DB::connection('ddtank')->table('Sys_Users_Goods')->insertGetId(
                        [
                            'UserID' => 0,
                            'BagType' => 0,
                            'TemplateID' => $promo->annex1 ?: 0,
                            'Place' => -1,
                            'Count' => $promo->annex1count ?: 0,
                            'Color' => "",
                            'StrengthenLevel' => 0,
                            'AttackCompose' => 0,
                            'DefendCompose' => 0,
                            'LuckCompose' => 0,
                            'AgilityCompose' => 0,
                            'IsBinds' => true,
                            'IsUsed' => false,
                            'BeginDate' => Carbon::now(),
                            'ValidDate' => 0,
                            'IsGold' => false,
                            'goldValidDate' => 30,
                            'latentEnergyCurStr' => "0,0,0,0",
                            'latentEnergyNewStr' => "0,0,0,0",
                            'latentEnergyEndTime' => Carbon::now(),
                        ]);
                    $slot2 = DB::connection('ddtank')->table('Sys_Users_Goods')->insertGetId(
                        [
                            'UserID' => 0,
                            'BagType' => 0,
                            'TemplateID' => $promo->annex2 ?: 0,
                            'Place' => -1,
                            'Count' => $promo->annex2count ?: 0,
                            'Color' => "",
                            'StrengthenLevel' => 0,
                            'AttackCompose' => 0,
                            'DefendCompose' => 0,
                            'LuckCompose' => 0,
                            'AgilityCompose' => 0,
                            'IsBinds' => true,
                            'IsUsed' => false,
                            'BeginDate' => Carbon::now(),
                            'ValidDate' => 0,
                            'IsGold' => false,
                            'goldValidDate' => 30,
                            'latentEnergyCurStr' => "0,0,0,0",
                            'latentEnergyNewStr' => "0,0,0,0",
                            'latentEnergyEndTime' => Carbon::now(),
                        ]);
                    $slot3 = DB::connection('ddtank')->table('Sys_Users_Goods')->insertGetId(
                        [
                            'UserID' => 0,
                            'BagType' => 0,
                            'TemplateID' => $promo->annex3 ?: 0,
                            'Place' => -1,
                            'Count' => $promo->annex3count ?: 0,
                            'Color' => "",
                            'StrengthenLevel' => 0,
                            'AttackCompose' => 0,
                            'DefendCompose' => 0,
                            'LuckCompose' => 0,
                            'AgilityCompose' => 0,
                            'IsBinds' => true,
                            'IsUsed' => false,
                            'BeginDate' => Carbon::now(),
                            'ValidDate' => 0,
                            'IsGold' => false,
                            'goldValidDate' => 30,
                            'latentEnergyCurStr' => "0,0,0,0",
                            'latentEnergyNewStr' => "0,0,0,0",
                            'latentEnergyEndTime' => Carbon::now(),
                        ]);
                    $slot4 = DB::connection('ddtank')->table('Sys_Users_Goods')->insertGetId(
                        [
                            'UserID' => 0,
                            'BagType' => 0,
                            'TemplateID' => $promo->annex4 ?: 0,
                            'Place' => -1,
                            'Count' => $promo->annex4count ?: 0,
                            'Color' => "",
                            'StrengthenLevel' => 0,
                            'AttackCompose' => 0,
                            'DefendCompose' => 0,
                            'LuckCompose' => 0,
                            'AgilityCompose' => 0,
                            'IsBinds' => true,
                            'IsUsed' => false,
                            'BeginDate' => Carbon::now(),
                            'ValidDate' => 0,
                            'IsGold' => false,
                            'goldValidDate' => 30,
                            'latentEnergyCurStr' => "0,0,0,0",
                            'latentEnergyNewStr' => "0,0,0,0",
                            'latentEnergyEndTime' => Carbon::now(),
                        ]);
                    $slot5 = DB::connection('ddtank')->table('Sys_Users_Goods')->insertGetId(
                        [
                            'UserID' => 0,
                            'BagType' => 0,
                            'TemplateID' => $promo->annex5 ?: 0,
                            'Place' => -1,
                            'Count' => $promo->annex5count ?: 0,
                            'Color' => "",
                            'StrengthenLevel' => 0,
                            'AttackCompose' => 0,
                            'DefendCompose' => 0,
                            'LuckCompose' => 0,
                            'AgilityCompose' => 0,
                            'IsBinds' => true,
                            'IsUsed' => false,
                            'BeginDate' => Carbon::now(),
                            'ValidDate' => 0,
                            'IsGold' => false,
                            'goldValidDate' => 30,
                            'latentEnergyCurStr' => "0,0,0,0",
                            'latentEnergyNewStr' => "0,0,0,0",
                            'latentEnergyEndTime' => Carbon::now(),
                        ]);
                        
                    try {
                        $mass = DB::connection('ddtank')->table('User_Messages')->insertGetId(
                        [
                            'SenderID' => 0,
                            'Sender' => env('IM_SENDER', "Promocode System"),
                            'ReceiverID' => $user->UserID,
                            'Receiver' => $user->NickName,
                            'Title' => "Активация промокода $promo->promoTitle",
                            'Content' => "$promo->promoDesc",
                            'Type' => 51,
                            'Remark' => "Gold:0,Money:0,Annex1:$slot1,Annex2:$slot2,Annex3:$slot3,Annex4:$slot4,Annex5:$slot5,GiftToken:0",
                            'Annex1' => "$slot1",
                            'Annex2' => "$slot2",
                            'Annex3' => "$slot3",
                            'Annex4' => "$slot4",
                            'Annex5' => "$slot5",
                        ]);
                        
                    } catch (\Exception $exception) {
                        
                        
                    }
                    return back()->withErrors('Промокод успешно активирован\nПредметы были отправлены в игру.');
                }
            } else {
                return back()->withErrors('Количество активаций у данного промокода закончилось.');
            }
        }

    }

}
