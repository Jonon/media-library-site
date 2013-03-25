var MediaLibrary = MediaLibrary || {};

MediaLibrary.XhrRequest = function(data, success, loading, async) {
	async = (async != null) ? async : true;
	var type = "POST";
    var url = "rpc.php";
    
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (success) {
            success(xhr.responseText);
        }
    }
    xhr.onprogress = function() {
        if (loading) {
            loading(xhr.responseText);
        }
    }
    xhr.open(type, url, async);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.setRequestHeader("Content-length", data.length);
	xhr.setRequestHeader("Connection", "close");
    xhr.send(data);
}