<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JS Test</title>
</head>

<body>
<script>
(function(d,p,i,a){
	i = 102201;
	d = document;
	p = {
		d : encodeURIComponent(d.domain),
		u : encodeURIComponent(d.location.href),
		t : encodeURIComponent(d.title),
		r : encodeURIComponent(d.referrer),
		a : 'http://www.obtel.me/index.php/hm/pd?id='+i
	}
	a = p.a + '&d='+p.d+'&u='+p.u+'&t='+p.t+'&r='+p.r;
	d.writeln(unescape("%3Cscript src='" + a + "' type='text/javascript'%3E%3C/script%3E"));
})();
</script>
</body>
</html>
