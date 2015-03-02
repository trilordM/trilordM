<div class="main-page-title"><!-- start main page title -->
			<div class="container">
				<div class="post-resume-page-title">Post a Resume</div>
				<div class="post-resume-phone">Call: 1 800 000 500</div>
			</div>
		</div><!-- end main page title -->
		<div class="container">
		<div class="spacer-1">&nbsp;</div>
			<div class="row">
				<div class="col-md-8">
					<form role="form" class="post-resume-form">
						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" class="form-control input" id="name" />
						</div>
						<div class="form-group">
							<label for="email">Your Email</label>
							<input type="email" class="form-control input" id="email" />
						</div>
						<div class="form-group">
							<label for="professionalauto">Professional Auto</label>
							<input type="text" class="form-control input" id="professionalauto" />
							<p>Leave this blank if the job can be done from anywhere (i.e. lorem ipsum)</p>
						</div>

						<div class="form-group">
							<label for="jobregion">Location</label>
							<select class="form-control" id="jobregion" >
								<option>Blank 1</option>
								<option>Blank 2</option>
								<option>Blank 3</option>
								<option>Blank 4</option>
								<option>Blank 5</option>
							</select>
						</div>

						<div class="form-group">
							<label for="photo">Photo <span>(Optional)</span> <small>Max. file size: 8 MB.</small></label>
							<div class="upload">
								<input type="file" id="photo">
							</div>
						</div>

						<div class="form-group">
							<label for="resumecategory">Resume Category</label>
							<select class="form-control" id="resumecategory" >
								<option>Blank 1</option>
								<option>Blank 2</option>
								<option>Blank 3</option>
								<option>Blank 4</option>
								<option>Blank 5</option>
							</select>
						</div>

						<div class="form-group">
							<label for="resumecontent">Resume Content</label>
							<textarea class="form-control textarea" id="resumecontent" ></textarea>
						</div>
						<div class="form-group">
							<label for="skill">Skills <span>(Optional)</span></label>
							<input type="text" class="form-control input" id="skill" />
						</div>
						<div class="form-group">
							<label for="addform-url">URL(S) <span>(Optional)</span></label>
							<br/>
							<button class="job-btn btn-black" id="addform-url">+ Add URL</button>
							<div id="post-resume-url">
							</div>
						</div>

						<div class="form-group">
							<label for="addform-education">Education <span>(Optional)</span></label>
							<br/>
							<button class="job-btn btn-black" id="addform-education">+ Add URL</button>
							<div id="post-resume-education">
							</div>
						</div>

						<div class="form-group">
							<label for="addform-exp">Experience <span>(Optional)</span></label>
							<br/>
							<button class="job-btn btn-black" id="addform-exp">+ Add URL</button>
							<div id="post-resume-exp">
							</div>
						</div>

						<div class="form-group">
							<label for="resumefile">Resume Files <span>(Optional)</span> <small> Optionally upload your resume for employers to view.</small></label>
							<div class="upload">
								<input type="file" id="resumefile">
							</div>
						</div>

						<div class="form-group">
							<button class="btn btn-default btn-green">POST A RESUME</button>
						</div>

					</form>
					<div class="spacer-2">&nbsp;</div>
				</div>

				<div class="col-md-4">
					<div class="job-side-wrap">
						<h4>ALREADY HAVE AN ACCOUNT?</h4>
						<p>
							Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search.
						</p>
						<p class="centering">
						<?php echo $this->html->link('LOG IN', array('controller'=>'users', 'action' => 'login'),array('class'=>'btn btn-default btn-green'));?></p>
					</div>

					<div class="job-side-wrap">
						<h4>Register With Us</h4>
						<p>
							At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti molestias
						</p>
						<p class="centering">
						<?php echo $this->html->link('REGISTER', array('controller'=>'users', 'action' => 'register',),array('class'=>'btn btn-default btn-black'));?>
						</p>
					</div>

				</div>
			</div>
			
		</div>
		<div id="page-content"><!-- start content -->
			<div class="content-about">
				<div id="cs"><!-- CS -->
					<div class="container">
					<div class="spacer-1">&nbsp;</div>
						<h1>Hey Friends Any Quries?</h1>
						<p>
							At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt.
						</p>
						<h1 class="phone-cs">Call: 1 800 000 500</h1>
					</div>
				</div><!-- CS -->
			</div><!-- end content -->
		</div><!-- end page content -->