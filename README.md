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
## Register - 密碼必須符合條件  
*少於8個字  
![image](https://github.com/diana8772/homebuy/blob/master//public/image/register_少於8位數.png)  
*多於20個字  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_多於20位數.png)  
*沒有包含一位以上的數字、大寫英文字、小寫英文字及特殊符號  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_格式不對.png)  
*將密碼設為min:8、max=20,並且要一位以上的數字、大寫英文字、小寫英文字及特殊符號  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/register_規則.png)  

## Login  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login頁面.png)  
*密碼錯誤
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_密碼錯誤.png)  
*密碼錯誤3次後，須等1分鐘才能繼續再次登入  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_密碼輸入錯誤超過3次.png)  
*防止暴力破解  
1.限制等待時間(decayMinutes)1分鐘  
2.輸入一次錯誤後，還有2次機會(maxAttempts)  
3.紀錄輸入的資料與目前使用者的ip位址  
4.判斷執行次數是否等於maxAttempts(hasTooManyLoginAttempts)  
5.計算並於等待時間內不能被登入(incrementLoginAttempts)  
6.於頁面中，顯示等待時間(sendLockoutResponse)  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/login_登入次數規則.png)  

## 登入首頁
*有人口統計資料、房地產資料、個人資料、權限的頁面可以進入
![image](https://github.com/diana8772/homebuy/blob/master/public/image/home頁面.png)  

## 權限  
*身分：admin - 除了自己的資料，還能看到user、guest的，並且能修改user、guest的權限與刪除資料
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面admin.png)  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_編輯權限.png)  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_刪除確認.png)
*身分：user - 除了自己的資料，還能看到guest的  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面user.png)  
*身分：guest - 只能看到自己的資料
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority的頁面guest.png)    
若是自己的資料，按"詳細"會跳至個人資訊的頁面，並且可直接編輯  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person的頁面.png)  
若是其他人的資料，按"詳細"會跳至個人資訊的頁面，但不能編輯  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/authority_詳細.png)  

## 個人資訊
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person的頁面.png)  
*生日使用日期選擇器  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_日期選擇.png)  
*若星號(必填)欄位未輸入時，跳出警告。若星號(必填)欄位都不為空值時，即可儲存  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/person_儲存空值.png)  

## 房地產資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate的頁面.png)  
*可藉由地區、日期、單價區間、總面積區間、屋齡來篩選資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_篩選.png)  
*新增時，若有空值，跳出警告。  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/estate_新增空值.png)  

## 人口統計資料  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics的頁面.png)  
*利用年、月、地區(複選)來篩選資料，並且顯示圖表  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics複選.png)  
*用滑鼠碰觸資料時，資料的背景色會跟著改變，並且顯示詳細數據  
![image](https://github.com/diana8772/homebuy/blob/master/public/image/demographics_碰資料.png)  
