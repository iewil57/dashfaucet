<?php
const host = "dash-faucet.xyz",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

//CLASS MODUL
function Run($u, $h = 0, $p = 0, $m = 0,$c = 0,$x = 0){//url,header,post,proxy
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($c){
		curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
		curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
	}
	if($p){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	if($m){
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $m);
	}
	if($x){
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_PROXY, $x);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd)[1];
	}
}
function bn(){
	system('clear');
	print "\n\n";
	print h."Author  : ".k."iewil".n;
	print h."Script  : ".k.host.n;
	print h."Youtube : ".k."youtube.com/c/iewil".n;
	print line();
}
function Line(){$l = 50;return b.str_repeat('─',$l).n;}
function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
function Save($namadata){
	if(file_exists($namadata)){$datauser=file_get_contents($namadata);}else{$datauser=readline(h."Input ".$namadata.p.' ≽'.n);file_put_contents($namadata,$datauser);}
	return $datauser;
}
function dash($ua){
	$r = Run(host,$ua);
	$u = explode('</b>',explode('<div class="text-primary"><b>',$r)[1])[0];//iewilmaestro
	$b = explode('</font>',explode('<font class="text-success">',$r)[1])[0];
	return ["user"=>$u,"bal"=>$b];
}
system("termux-open-url https://youtu.be/fglboCNSxWc");

bn();
cookie:
$user_agent = Save('User_Agent');
$cookie     = Save('Cookie');

bn();
$ua  = ["cookie: ".$cookie,"user-agent: ".$user_agent];
$h   = ["Host: ".host,"X-Requested-With: XMLHttpRequest","cookie: ".$cookie,"user-agent: ".$user_agent];
$uas = ["Host: api-secure.solvemedia.com","user-agent: ".$user_agent,"accept: */*","https://claimbits.net/faucet.html"];

$r = dash($ua);
echo h."Username   ~> ".k.$r["user"].n;
echo h."Balance    ~> ".k.$r["bal"].n;
print Line();

menu:
echo m."1 >".p." Auto Faucet\n";
echo m."2 >".p." Withdraw\n";
echo m."3 >".p." Update Cookie\n";
$pil = readline(h."Input Number ".m."> ");
print line();
if($pil==1){goto auto;
}elseif($pil==2){goto wd;
}elseif($pil==3){unlink("Cookie");goto cookie;
}else{echo m."Bad Number\n".n;print l();goto menu;}
