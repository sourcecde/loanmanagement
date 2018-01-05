<script type="text/javascript">
  var page_id = "<?php echo $page_id; ?>";
  var page_top_id = "<?php echo $page_top_id; ?>";
  if(page_id!="")
  document.getElementById(page_id).classList.add("active");
  else if(page_top_id!="")
    document.getElementById(page_top_id).classList.add("active");
</script>
</body>
</html>
