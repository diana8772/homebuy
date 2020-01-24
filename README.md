# AWIN新生作業  
## 使用系統  
1.Wampserver64  
2.Apache 2.4.39  
3.MySQL 5.7.26  
4.PHP 7.3.5  
5.Laravel 6.11.0  

## 首頁  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/welcome頁面.png)  
右上角有Login與Register的功能  

## Register  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register頁面.png)  
### Register - 密碼必須符合條件  
### *少於8個字  
![image](https://github.com/diana8772/homebuy/blob/master//public/image/register_少於8位數.png)  
### *多於20個字  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_多於20位數.png)  
### *沒有包含一位以上的數字、大寫英文字、小寫英文字及特殊符號  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_格式不對.png)  
### 程式說明 
*將密碼設為min:8、max=20,並且要一位以上的數字、大寫英文字、小寫英文字及特殊符號  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_規則.png)  

## Login  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login頁面.png)  
### *密碼錯誤
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_密碼錯誤.png)  
### *密碼錯誤3次後，須等1分鐘才能繼續再次登入  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_密碼輸入錯誤超過3次.png)  
### 程式說明 - 防止暴力破解  
  1.限制等待時間(decayMinutes)1分鐘  
  2.輸入一次錯誤後，還有2次機會(maxAttempts)  
  3.紀錄輸入的資料與目前使用者的ip位址(throttleKey)  
  4.判斷執行次數是否等於maxAttempts(hasTooManyLoginAttempts)  
  5.計算並於等待時間內不能被登入(incrementLoginAttempts)  
  6.於頁面中，顯示等待時間(sendLockoutResponse)  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_登入次數規則.png)  

## 登入首頁  
### *有人口統計資料、房地產資料、個人資料、權限的頁面可以進入  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/home頁面.png)  

## 權限  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面admin.png)  
### *身分：admin - 除了自己的資料，還能看到user、guest的，並且能修改user、guest的權限與刪除資料  
*編輯權限  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_編輯權限.png)  
*刪除  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_刪除確認.png)  
### *身分：user - 除了自己的資料，還能看到guest的  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面user.png)  
### *身分：guest - 只能看到自己的資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面guest.png)  
### 若是自己的資料，按"詳細"會跳至個人資訊的頁面，並且可直接編輯  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person的頁面.png)  
### 若是其他人的資料，按"詳細"會跳至個人資訊的頁面，但不能編輯  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_詳細.png)  
### 程式說明 - 權限  
#### *在資料庫裡，我將權限admin改為1admin、user改為2user、guest改為3guest(比較好排序)  
#### *user、guest剛註冊時，權限等於"",admin透過編輯權限來修改  
#### *Auth::user()->role(前端)、auth()->user()->role(後端)可以得知目前登入帳號的權限  
#### *後端：  
  1.判斷目前權限，利用where、orwhere來篩選，並且取得資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_權限程式contoller.png)  
#### *前端：  
  1.利用foreach顯示資料  
  2.Auth::user()->role == '1admin' && $row->role != '1admin' 如果目前是1admin 並且該列資料不是自己的才能顯示刪除、編輯按鈕(因為將1admin刪掉或修改權限就沒人管控)  
  3.@if(isset($edit) && $edit == $row->id) 編輯被按下，並且得知是哪列被編輯，該列按鈕改為儲存  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_權限程式.png)  
### 資料庫  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/資料庫user.png)  

## 個人資訊  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person的頁面.png)  
### 生日使用日期選擇器  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_日期選擇.png)  
### 若星號(必填)欄位未輸入時，跳出警告。若星號(必填)欄位都不為空值時，即可儲存  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_儲存空值.png)  
### 程式說明  
#### 剛註冊時，只有建users的表格，登入後須至個人資訊頁裡修改資料，修改後資料庫person_data才會新增使用者資料  
### 前端  
1.利用onclick="javascript:return insert1()" 來判斷必填欄位是否為空值  
2.利用document.getElementById("fullname")、 var fullname1 = fullname.value;來取值...  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_儲存程式.png)  
3.若有任一個欄位未填寫，跳出提示訊息，並且不跳頁傳值  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_js程式.png)  
### 後端  
1.$request->has('id') 判斷是否有id值從前端傳來、$request->input('id')取得id值  
2.利用key()來讀取在前端儲存按鈕內隱藏的id值  
3.用$ckeck來確認該使用者的資料是否已經存在，並且再次判斷必填欄位是否被填寫  
  *count($ckeck)==0 表示該使用者的資料還未存在，若必填欄位都填寫了，則person_data會新增一筆使用者資料  
  *count($ckeck)!=0 表示該使用者的資料已存在，若必填欄位都填寫了，則person_data會更新使用者資料  
4.新增或更新完後，再將$ckeck更新一次  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_新增程式.png)  
### 資料庫  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/資料庫person_data.png)  

## 房地產資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate的頁面.png)  
### *可藉由地區、日期、單價區間、總面積區間、屋齡來篩選資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_篩選.png)  
### *新增時，若有空值，跳出警告。  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_新增空值.png)  
### 程式說明  
*當還未有input值時，下拉選單必須先給預設值  
### 前端  
#### 1.地區的下拉選單預設值為""，指的是"全部"的意思。並且選單內新增"全部"的選項及所有地區  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式地區下拉.png)  
#### 2.年份的下拉選單預設值為108  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式年下拉.png)  
#### 3.月份的下拉選單預設值為12  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式月下拉.png)  
#### 4.每坪單價以區間來篩選預設為1~50  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式單價下拉.png)  
#### 5.總面積以區間來篩選預設為1~300  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式總面積下拉.png)  
#### 6.屋齡的下拉選單預設值為""，指的是"全部"的意思。並且選單內新增"全部"的選項及所有屋齡  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式屋齡下拉.png)  
#### 7.利用onclick="javascript:return insert1()" 來判斷必填欄位是否為空值  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式儲存.png)  
#### 8.利用document.getElementById("insert_local")、 var insert_local1 = insert_local.value;來取值...  
#### 9.若有任一個欄位未填寫，跳出提示訊息，並且不跳頁傳值  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式js儲存.png)  
### 後端  
#### 1.新增  
  *利用$request->input('insert_local')來得取輸入的欄位值  
  *$id = DB::table("estate")->select('id')->max('id')+1; 找到目前最大的id，並且+1，當作這次新增時用的id值  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式後端儲存.png)  
#### 2.$local為所有地區的名稱，用來當下拉選單  
  *用groupby()將相同的地區名稱用成一群，不取到重覆的值  
  *用pluck()只取值，並將所有的值存成陣列  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式後端地區.png)  
#### 3.$estate為房地產資料  
  *利用  ->where('單價', '>=', $minunit)及->where('單價', '<=', $maxunit)來做單價區間的篩選  
  *利用  ->where('總面積', '>=', $minarea)及->where('總面積', '>=', $maxarea)來做單價區間的篩選  
  *利用此段程式來判斷$age不為空值時才篩選  
  <table>
  	<tr><td>->where(function($query) use ($age){  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;if(!empty($age)): {  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$query->Where('屋齡', $age);  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;endif;  </td></tr>
	<tr><td>}) </td></tr>
  </table>
  *利用此段程式來判斷$select_loccal不為空值時才篩選  
  <table>
  	<tr><td>->where(function($query) use ($select_loccal){  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;if(!empty($select_loccal)): {  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$query->Where('地區', $select_loccal);  </td></tr>
	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;endif;  </td></tr>
	<tr><td>}) </td></tr>
  </table>  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_程式後端房地產.png)  

## 人口統計資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics的頁面.png)  
### *利用年、月、地區(複選)來篩選資料，並且顯示圖表  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics複選.png)  
### *用滑鼠碰觸資料時，資料的背景色會跟著改變，並且顯示詳細數據  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_碰資料.png)  
### 程式說明  
### 前端  
#### 1.年份的下拉選單預設值為108  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式年份下拉.png)  
#### 2.月份的下拉選單預設值為12  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式月份下拉.png)  
#### 3.地區的下拉選單  
  *預設為""，指的是"全部"的意思  
  *並於選單內新增"全部"的選項及所有地區  
  *可複選，將select設為multiple="multiple"，並利用js讀取所有選取的地區值  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式地區下拉.png)  
  *按"查詢"後，利用js讀取地區選單，並將數據傳至文字入欄位，方便後端讀取  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式js複選.png)  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式js複選text.png) 
#### 4.數據圖表  
  *將篩選過後的數據以圖表方式呈現，方便觀看資料  
  *將數值套用number_format()函數，將數值格式化，每3位數加1位逗號  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式公式.png)  
  *套用Chart.js來設計圖表  
  *利用hoverBackgroundColor、hoverBorderColor設計動態效果，當資料列被碰觸時，會使資料列變色  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式js圖表.png)  
  *利用options、scales讓y軸與x軸顯示名稱，並且利用下述程式將y軸數值格式化，每3位數加1位逗號  
		callback: function (value, index, values) {  
			return value.toLocaleString();  
		}  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式jsxy軸.png)  
### 後端  
#### 1.$local為所有地區的名稱，用來當下拉選單  
####   *用groupby()將相同的地區名稱用成一群，不取到重覆的值  
####   *用pluck()只取值，並將所有的值存成陣列  
#### 2.$select_local == ""，表示"全選; $select_local != ""，表示有選取其他地區  
  *$request->input('select_locals')為前端所選取的地區值，為字串，必須用$pieces = explode(",", $select_local)來將字串做切割  
  *$data使用的$year、$month為預設值來篩選，並利用whereIn來篩選包含pieces的"區域值"  
  *$charts為圖表需要的數據，使用的$year、$month為預設值來篩選，並利用whereIn來篩選包含pieces的"區域值"，並且只選取總計數與區域值  
  *將charts分別pluck區域別、總計，只讀取value值 例如:  
	<span style="background-color: #aaaaaa;">  
		&nbsp;&nbsp;區域別 => "中區",  
		&nbsp;&nbsp;區域別 => "北區",  
		&nbsp;&nbsp;區域別 => "北屯區",  
		&nbsp;&nbsp;區域別 => "南區",  
	</span>  
   轉換成  
  	<span style="background-color: #aaaaaa;">
  		&nbsp;&nbsp;"中區",  
		&nbsp;&nbsp;"北區",  
		&nbsp;&nbsp;"北屯區",  
		&nbsp;&nbsp;"南區",  
  	</span>  
  *並分別將區域別、總計利用json_encode轉成陣列 例如:  
    <span style="background-color: #aaaaaa;">  
    	&nbsp;&nbsp;,0 => "中區,  
		&nbsp;&nbsp;,1 => "北區,  
		&nbsp;&nbsp;2 => "北屯區",  
		&nbsp;&nbsp;3 => "南區",  
    </span>  
   轉換成   
   	<span style="background-color: #aaaaaa;">  
   		"中區", "北區", "北屯區", "南區"  
   	</span>  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_程式後端讀取資料.png)  
