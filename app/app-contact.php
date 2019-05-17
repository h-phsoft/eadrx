<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <form class="form-signin" method="post" action="<?php echo $PH_BASE_PATH . '?' . $nLang . '/' . ph_Setting('App-Mode-Contact') . '/1'; ?>">
            <div class="form-label-group">
              <input type="text" id="inputSubject" name="inputSubject" class="form-control" placeholder="Subject" required autofocus>
              <label for="inputSubject">Subject</label>
            </div>
            <div class="form-label-group">
              <textarea class="app-form-control" id="inputMessage" name="inputMessage" rows="5" placeholder="Message"></textarea>
              <label for="inputTextarea">Message</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
