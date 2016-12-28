<center>
  <form action="" method="post">
    <table>
      <tr>
        <td>Post Title: <input type="text" name="posttitle" value="{posttitle}" placeholder="Enter Post Title"></td>
        <td style="color:red;">{errPosttitle}</td>
      </tr>
      <tr>
        <td>Post: </td>
      </tr>
      <tr>
        <td ><pre><textarea rows='35' cols='150' name="post">{post}</textarea></pre></td>
        <td style="color:red;">{errPost}</td>
      </tr>
      <tr>
        <td>Tag: <input type="text" name="tag" value="{tag}" placeholder="Enter Tag.."></td>
        <td style="color:red;">{errTag}</td>
      </tr>
      <tr>
        <td><input type="submit" name="submit" value="Submit"></td>
      </tr>
    </table>
  </form>
</center>
