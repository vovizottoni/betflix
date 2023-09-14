<section class="section main-section">
    <div class="card mb-6">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-ballot"></i></span>
          Forms
        </p>
      </header>
      <div class="card-content flex flex-col gap-2">
        <label class="label">Mensagens</label>
          <div class="alert alert-success shadow-lg">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>Your purchase has been confirmed!</span>
            </div>
          </div>
          <div class="alert alert-warning shadow-lg">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
              <span>Warning: Invalid email address!</span>
            </div>
          </div>
          <div class="alert alert-error shadow-lg">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>Error! Task failed successfully.</span>
            </div>
          </div>

      </div>

      <div class="card-content flex flex-col gap-2">

        <label class="label">Modal</label>

            <!-- The button to open modal -->
            <label for="my-modal" class="btn w-36">open modal</label>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal" class="modal-toggle" />
            <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
                <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
                <div class="modal-action">
                <label for="my-modal" class="btn">Yay!</label>
                </div>
            </div>
            </div>

      </div>

      <div class="card-content">
        <form method="get">
          <div class="field">
            <label class="label">From</label>
            <div class="field-body">
              <div class="field">
                <div class="control icons-left">
                  <input class="input" type="text" placeholder="Name">
                  <span class="icon left"><i class="mdi mdi-account"></i></span>
                </div>
              </div>
              <div class="field">
                <div class="control icons-left icons-right">
                  <input class="input" type="email" placeholder="Email" value="alex@smith.com">
                  <span class="icon left"><i class="mdi mdi-mail"></i></span>
                  <span class="icon right"><i class="mdi mdi-check"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="field">
            <div class="field-body">
              <div class="field">
                <div class="field addons">
                  <div class="control border-r border-r-zinc-400">
                    <input class="input" value="+55" size="3">
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" placeholder="Your phone number">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="field">
            <label class="label">Department</label>
            <select class="select select-bordered w-full max-w-xs">
                <option disabled selected>Who shot first?</option>
                <option>Han Solo</option>
                <option>Greedo</option>
            </select>
          </div>
          <hr>
          <div class="field">
            <label class="label">Subject</label>

            <div class="control">
              <input class="input" type="text" placeholder="e.g. Partnership opportunity">
            </div>
            <p class="help">
              This field is required
            </p>
          </div>

          <div class="field">
            <label class="label">Question</label>
            <div class="control">
              <textarea class="textarea" placeholder="Explain how we can help you"></textarea>
            </div>
          </div>
          <hr>

          <div class="field grouped">
            <div class="control">
              <button type="submit" class="button green">
                Submit
              </button>
            </div>
            <div class="control">
              <button type="reset" class="button red">
                Reset
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-ballot-outline"></i></span>
          Custom elements
        </p>
      </header>
      <div class="card-content">
        <div class="field">
          <label class="label">Checkbox</label>
          <div class="field-body">
            <div class="field grouped multiline">
                <div class="form-control">
                    <label class="label cursor-pointer">
                      <span class="label-text">Usar esse</span>
                      <input type="checkbox" checked="checked" class="checkbox" />
                    </label>
                </div>
                <div class="form-control">
                    <label class="label cursor-pointer">
                      <span class="label-text">Esse talvez</span>
                      <input type="checkbox" checked="checked" class="checkbox" />
                    </label>
                </div>
                <div class="form-control">
                    <label class="label cursor-pointer">
                      <span class="label-text">Esse aqui não</span>
                      <input type="checkbox" class="checkbox" />
                    </label>
                </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="field">
          <label class="label">Radio</label>
          <div class="field-body">
            <div class="form-control">
                <label class="label cursor-pointer">
                  <span class="label-text">Red pill</span>
                  <input type="radio" name="radio-10" class="radio checked:bg-red-500 checked:hover:bg-red-500 focus:bg-red-500" checked />
                </label>
              </div>
              <div class="form-control">
                <label class="label cursor-pointer">
                  <span class="label-text">Blue pill</span>
                  <input type="radio" name="radio-10" class="radio checked:bg-blue-500" checked />
                </label>
            </div>
          </div>
        </div>
        <hr>
        <div class="field">
          <label class="label">Switch</label>
          <div class="field-body">
            <div class="field">
              <label class="switch">
                <input type="checkbox" value="false">
                <span class="check"></span>
                <span class="control-label">Default</span>
              </label>
            </div>
          </div>
        </div>
        <hr>
        <div class="field">
          <label class="label">File</label>
          <input type="file" class="file-input file-input-bordered w-full max-w-xs" />
        </div>
      </div>
    </div>
  </section>


