# oha.gg.open
[oha.gg](https://oha.gg) 에서 실제 사용 코드입니다. 단, 최신 코드가 아닐 수 있습니다. 매번 마일스톤이 완료 될때마다 갱신을 목표로 하고 있습니다.  
개인적인 정보 부분은 아래 내용을 참고해서 운영 서버에 맞도록 직접 수정을 하셔야합니다.  

[CodeIgniter4](https://github.com/codeigniter4/CodeIgniter4) 를 사용하여서 사이트를 운영중에 있습니다.  
코드이그나이터4를 설치 후 해당 폴더 및 파일을 덮어써주세요.  

## 수정 파일 리스트
### 공통
1. [Autoload.php](app/Config/Autoload.php)  
   모든 게임을 적용하는것이 아닌, 특정 게임만 운영하고 싶으시다면 수정을 진행합니다.
2. [Cdn.php](modules/Core/Config/Cdn.php)  
   CDN 을 사용하는 경우, domain URL을 입력해주세요.
3. [Cms.php](modules/Core/Config/Cms.php)  
   name 에 사이트 이름을 입력해주세요. 그외에 수정이 필요한 부분도 수정해줍니다.
4. [Registrar.php](modules/Core/Config/Registrar.php)  
   App() 함수 내부에서 baseURL 에 사이트 URL 을 입력합니다. 그외에 필요한 수정이 있다면 적절히 수정합니다.  
   Cache() 함수 내부에서 prefix 값을 필요한 경우 수정합니다.  
   Database() 함수 내부에서 DB 접속 정보를 수정합니다.  
   Encryption() 함수 내부에서 암호화에 필요한 key 를 수정합니다.  

### NEXON
#### 마비노기
1. [Api.php](modules/Nexon/Mabinogi/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 마비노기 영웅전
1. [Api.php](modules/Nexon/MabinogiHeroes/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 메이플스토리M
1. [Api.php](modules/Nexon/MapleStoryM/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 바람의나라
1. [Api.php](modules/Nexon/Baram/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 바람의나라: 연
1. [Api.php](modules/Nexon/BaramY/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 카트라이더 러쉬플러스
1. [Api.php](modules/Nexon/KartRiderRushPlus/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 크레이지 아케이드
1. [Api.php](modules/Nexon/CrazyArcade/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### 퍼스트 디센던트
1. [Api.php](modules/Nexon/FirstDescendant/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### HIT2
1. [Api.php](modules/Nexon/Hit2/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### SUPERVIVE
1. [Api.php](modules/Nexon/Supervive/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

#### V4
1. [Api.php](modules/Nexon/V4/Config/Api.php)  
   개발키(dev)와 실제 서버키(prod)를 수정합니다.  

### NCSOFT
#### 리니지2M
1. [Api.php](modules/NcSoft/Lineage2M/Config/Api.php)  
   API Key 를 수정합니다.  

## DB 설치
개발모드(SetEnv CI_ENVIRONMENT development)로 메인 페이지에 접근하시면, 모듈 업데이트 버튼이 생성됩니다.  
해당 버튼으로 DB 설치 및 업데이트가 가능합니다.  

## Cron
[cron.sh](cron.sh) 파일에 정리되어있습니다.  
해당 파일을 참고해서 운영하는 서버에 맞게 수정후 적용해주세요.  
운영되는 사이트에서는 cron.sh 파일을 1분에 한번씩 호출하고 있습니다.  

## 여담
해당 소스코드들은 과거부터 CI4 를 배워보고 싶다면서 소스코드 공개를 원하시는 분들이 많으셨는데, 그분들을 위한 소스코드 공개용 깃허브입니다.  
해당 소스코드들을 활용하여서 CI4 를 조금이나마 배우는데 도움이 됬으면 좋겠습니다.  

제가 평소에 쓰는 방식을 거의 그대로 가져왔기 때문에, 현재 사이트에서는 사용되지 않는 코드가 있을 수 있습니다.  
현재 사용하지 않더라도, 추후 업데이트때 사용 할 수도 있겠다 싶어서 남겨둔 소스코드들이기 때문에, 그냥 참고만 해주시면 감사합니다.  

몇년전부터 오픈용 소스코드 작성을 계속 꾸준히 시도했었으나 딱히 괜찮은 아이템을 찾지 못하여 공개를 못하다가, 게임 API 를 활용한 사이트면 재미있을거 같아서 해당 사이트 코드를 공개합니다.  
해당 소스코드들을 참고하셔서 더 발전된 사이트를 만드셔도 괜찮습니다.  

이미지의 경우 S3 에 저장해서 CDN 으로 보여주는 코드도 넣으려고 했었으나, 넥슨측에서 고정적인 이미지는 제공해주지 않기 때문에 우선은 비공개입니다.  
추후 고정된 이미지를 서버에서 CURL 등으로 다운로드가 가능하게 해준다면, 해당부분 작업을 진행해서 공개 예정입니다.  

소스코드에 대한 문의사항은 이슈트레커 혹은 사이트에 존재하는 디스코드 서버 oha_gg 채널에서 문의해주세요.  

자기자신이 플레이중인 게임이 API 를 제공하는데, 괜찮은 사이트가 없어서 만들어 달라는 문의도 받고있습니다.  
게임 종류는 지속적으로 추가 예정입니다.  
