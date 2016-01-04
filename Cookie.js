

  var today = new Date();
  var expiry = new Date(today.getTime() + 30 * 24 * 3600 * 1000); //30 jours

  function setCookie(name, value)
  {
    document.cookie=name + "=" + escape(value) + "; path=/; expires=" + expiry.toGMTString();
  }
  
  function getCookie(name)
  {
    var re = new RegExp(name + "=([^;]+)");
    var value = re.exec(document.cookie);
    return (value != null) ? unescape(value[1]) : null;
  }
  
  var expired = new Date(today.getTime() - 24 * 3600 * 1000); // Moins de 24h

  function deleteCookie(name)
  {
    document.cookie=name + "=null; path=/; expires=" + expired.toGMTString();
  }
