@extends('layouts.be.be')

@section('content')
	<div id='mainContent'>
		<!-- Top Menu Breadcrumb -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<div class="grid_layouts --two-auto">
				<div class="head-lst">
					<h5 class="page-title mb-0">Home</h5>
				</div>
				<div class="mn-rght">
					<ol class="breadcrumb">
						<li><a href="javascript:void(0)">Users</a></li>
						<li class="active">User List</li>
					</ol>
				</div>
			</div>
		</div>
	
		<!-- Alert -->
		<!-- ============================================================== -->
		<div class="row gap-20 masonry pos-r">
			<div class="masonry-sizer col-md-6"></div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Alerts</h6>
					<div class="mT-30">
						<div class="alert alert-primary" role="alert">
							This is a primary alert—check it out!
						</div>
						<div class="alert alert-secondary" role="alert">
							This is a secondary alert—check it out!
						</div>
						<div class="alert alert-success" role="alert">
							This is a success alert—check it out!
						</div>
						<div class="alert alert-danger" role="alert">
							This is a danger alert—check it out!
						</div>
						<div class="alert alert-warning" role="alert">
							This is a warning alert—check it out!
						</div>
						<div class="alert alert-info" role="alert">
							This is a info alert—check it out!
						</div>
						<div class="alert alert-light" role="alert">
							This is a light alert—check it out!
						</div>
						<div class="alert alert-dark" role="alert">
							This is a dark alert—check it out!
						</div>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Buttons</h6>
					<div class="mT-30">
						<div class="gap-10 peers">
							<div class="peer">
								<button type="button" class="btn cur-p btn-primary">Primary</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-secondary">Secondary</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-success">Success</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-danger">Danger</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-warning">Warning</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-info">Info</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-light">Light</button>
							</div>
							<div class="peer">
								<button type="button" class="btn cur-p btn-dark">Dark</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
				<h6 class="c-grey-900">Dropdowns</h6>
				<div class="mT-30">
					<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Dropdown button
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>

					<!-- Example split danger button -->
					<div class="btn-group mT-20">
						<button type="button" class="btn btn-danger">Action</button>
						<button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Modal</h6>
					<div class="mT-30">
						<!-- Button trigger modal -->
						<button id="tesmodal" type="button" class="btn btn-primary">
							Launch demo modal
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										...
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save changes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Sweetalert</h6>
					<div class="mT-30">
						<button id="sa-test" type="button" class="btn btn-primary">
							Launch demo sweetalert
						</button>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Popover</h6>
					<div class="mT-30">
						<button type="button" class="btn btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Progress</h6>
					<div class="mT-30">
						<!-- Progress Bars -->
						<div class="layers">
							<div class="layer w-100">
								<h5 class="mB-5">100k</h5>
								<small class="fw-600 c-grey-700">Visitors From USA</small>
								<span class="pull-right c-grey-600 fsz-sm">50%</span>
								<div class="progress mT-10">
									<div class="progress-bar bgc-deep-purple-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span></div>
								</div>
							</div>
							<div class="layer w-100 mT-15">
								<h5 class="mB-5">1M</h5>
								<small class="fw-600 c-grey-700">Visitors From Europe</small>
								<span class="pull-right c-grey-600 fsz-sm">80%</span>
								<div class="progress mT-10">
									<div class="progress-bar bgc-green-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">80% Complete</span></div>
								</div>
							</div>
							<div class="layer w-100 mT-15">
								<h5 class="mB-5">450k</h5>
								<small class="fw-600 c-grey-700">Visitors From Australia</small>
								<span class="pull-right c-grey-600 fsz-sm">40%</span>
								<div class="progress mT-10">
									<div class="progress-bar bgc-light-blue-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:40%;"> <span class="sr-only">40% Complete</span></div>
								</div>
							</div>
							<div class="layer w-100 mT-15">
								<h5 class="mB-5">1B</h5>
								<small class="fw-600 c-grey-700">Visitors From India</small>
								<span class="pull-right c-grey-600 fsz-sm">90%</span>
								<div class="progress mT-10">
									<div class="progress-bar bgc-blue-grey-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">90% Complete</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Tootips</h6>
					<div class="mT-30">
						<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
							Tooltip on top
						</button>
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
							Tooltip on right
						</button>
						<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
							Tooltip on bottom
						</button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Tooltip on left">
							Tooltip on left
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Card -->
		<!-- ============================================================== -->
		<div class="row gap-20 pos-r">
			<div class="masonry-sizer col-md-6"></div>
			<div class="masonry-item  w-100">
				<div class="row gap-20">
					<!-- #Toatl Visits ==================== -->
					<div class='col-md-3'>
						<div class="layers bd bgc-white p-20">
							<div class="layer w-100 mB-10">
								<h6 class="lh-1">Total Visits</h6>
							</div>
							<div class="layer w-100">
								<div class="peers ai-sb fxw-nw">
									<div class="peer peer-greed">
										<span id="sparklinedash"></span>
									</div>
									<div class="peer">
										<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">+10%</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- #Total Page Views ==================== -->
					<div class='col-md-3'>
						<div class="layers bd bgc-white p-20">
							<div class="layer w-100 mB-10">
								<h6 class="lh-1">Total Page Views</h6>
							</div>
							<div class="layer w-100">
								<div class="peers ai-sb fxw-nw">
									<div class="peer peer-greed">
										<span id="sparklinedash2"></span>
									</div>
									<div class="peer">
										<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- #Unique Visitors ==================== -->
					<div class='col-md-3'>
						<div class="layers bd bgc-white p-20">
							<div class="layer w-100 mB-10">
								<h6 class="lh-1">Unique Visitor</h6>
							</div>
							<div class="layer w-100">
								<div class="peers ai-sb fxw-nw">
									<div class="peer peer-greed">
										<span id="sparklinedash3"></span>
									</div>
									<div class="peer">
										<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">~12%</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- #Bounce Rate ==================== -->
					<div class='col-md-3'>
						<div class="layers bd bgc-white p-20">
							<div class="layer w-100 mB-10">
								<h6 class="lh-1">Bounce Rate</h6>
							</div>
							<div class="layer w-100">
								<div class="peers ai-sb fxw-nw">
									<div class="peer peer-greed">
										<span id="sparklinedash4"></span>
									</div>
									<div class="peer">
										<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">33%</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Datatables -->
    	<!-- ============================================================== -->
		<div class="row gap-20 pos-r">
			<div class="masonry-item col-md-12">
				<div class="bgc-white bd bdrs-3 p-20 mB-20">
					<div class="grid_layouts --two-auto">
						<div class="head-lst">
							<h3 class="page-title">Text Datatables</h3>
						</div>
						<div class="mn-rght">
							<button class="addbsnt --pluses">
								<a href="http://127.0.0.2/vim-fe/public/manage/supplier/tambah">
									<i class="ti-plus"></i>
								</a>
							</button>
						</div>
					</div>
					<table id="dataTableExample" class="table table-striped table-bordered" cellspacing="0" width="auto">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
						</tfoot>
						<tbody>
							<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>2011/04/25</td>
								<td>$320,800</td>
							</tr>
							<tr>
								<td>Garrett Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>2011/07/25</td>
								<td>$170,750</td>
							</tr>
							<tr>
								<td>Ashton Cox</td>
								<td>Junior Technical Author</td>
								<td>San Francisco</td>
								<td>66</td>
								<td>2009/01/12</td>
								<td>$86,000</td>
							</tr>
							<tr>
								<td>Cedric Kelly</td>
								<td>Senior Javascript Developer</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>2012/03/29</td>
								<td>$433,060</td>
							</tr>
							<tr>
								<td>Airi Satou</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>33</td>
								<td>2008/11/28</td>
								<td>$162,700</td>
							</tr>
							<tr>
								<td>Brielle Williamson</td>
								<td>Integration Specialist</td>
								<td>New York</td>
								<td>61</td>
								<td>2012/12/02</td>
								<td>$372,000</td>
							</tr>
							<tr>
								<td>Herrod Chandler</td>
								<td>Sales Assistant</td>
								<td>San Francisco</td>
								<td>59</td>
								<td>2012/08/06</td>
								<td>$137,500</td>
							</tr>
							<tr>
								<td>Rhona Davidson</td>
								<td>Integration Specialist</td>
								<td>Tokyo</td>
								<td>55</td>
								<td>2010/10/14</td>
								<td>$327,900</td>
							</tr>
							<tr>
								<td>Colleen Hurst</td>
								<td>Javascript Developer</td>
								<td>San Francisco</td>
								<td>39</td>
								<td>2009/09/15</td>
								<td>$205,500</td>
							</tr>
							<tr>
								<td>Sonya Frost</td>
								<td>Software Engineer</td>
								<td>Edinburgh</td>
								<td>23</td>
								<td>2008/12/13</td>
								<td>$103,600</td>
							</tr>
							<tr>
								<td>Jena Gaines</td>
								<td>Office Manager</td>
								<td>London</td>
								<td>30</td>
								<td>2008/12/19</td>
								<td>$90,560</td>
							</tr>
							<tr>
								<td>Quinn Flynn</td>
								<td>Support Lead</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>2013/03/03</td>
								<td>$342,000</td>
							</tr>
							<tr>
								<td>Charde Marshall</td>
								<td>Regional Director</td>
								<td>San Francisco</td>
								<td>36</td>
								<td>2008/10/16</td>
								<td>$470,600</td>
							</tr>
							<tr>
								<td>Haley Kennedy</td>
								<td>Senior Marketing Designer</td>
								<td>London</td>
								<td>43</td>
								<td>2012/12/18</td>
								<td>$313,500</td>
							</tr>
							<tr>
								<td>Tatyana Fitzpatrick</td>
								<td>Regional Director</td>
								<td>London</td>
								<td>19</td>
								<td>2010/03/17</td>
								<td>$385,750</td>
							</tr>
							<tr>
								<td>Michael Silva</td>
								<td>Marketing Designer</td>
								<td>London</td>
								<td>66</td>
								<td>2012/11/27</td>
								<td>$198,500</td>
							</tr>
							<tr>
								<td>Paul Byrd</td>
								<td>Chief Financial Officer (CFO)</td>
								<td>New York</td>
								<td>64</td>
								<td>2010/06/09</td>
								<td>$725,000</td>
							</tr>
							<tr>
								<td>Gloria Little</td>
								<td>Systems Administrator</td>
								<td>New York</td>
								<td>59</td>
								<td>2009/04/10</td>
								<td>$237,500</td>
							</tr>
							<tr>
								<td>Bradley Greer</td>
								<td>Software Engineer</td>
								<td>London</td>
								<td>41</td>
								<td>2012/10/13</td>
								<td>$132,000</td>
							</tr>
							<tr>
								<td>Dai Rios</td>
								<td>Personnel Lead</td>
								<td>Edinburgh</td>
								<td>35</td>
								<td>2012/09/26</td>
								<td>$217,500</td>
							</tr>
							<tr>
								<td>Jenette Caldwell</td>
								<td>Development Lead</td>
								<td>New York</td>
								<td>30</td>
								<td>2011/09/03</td>
								<td>$345,000</td>
							</tr>
							<tr>
								<td>Yuri Berry</td>
								<td>Chief Marketing Officer (CMO)</td>
								<td>New York</td>
								<td>40</td>
								<td>2009/06/25</td>
								<td>$675,000</td>
							</tr>
							<tr>
								<td>Caesar Vance</td>
								<td>Pre-Sales Support</td>
								<td>New York</td>
								<td>21</td>
								<td>2011/12/12</td>
								<td>$106,450</td>
							</tr>
							<tr>
								<td>Doris Wilder</td>
								<td>Sales Assistant</td>
								<td>Sidney</td>
								<td>23</td>
								<td>2010/09/20</td>
								<td>$85,600</td>
							</tr>
							<tr>
								<td>Angelica Ramos</td>
								<td>Chief Executive Officer (CEO)</td>
								<td>London</td>
								<td>47</td>
								<td>2009/10/09</td>
								<td>$1,200,000</td>
							</tr>
							<tr>
								<td>Gavin Joyce</td>
								<td>Developer</td>
								<td>Edinburgh</td>
								<td>42</td>
								<td>2010/12/22</td>
								<td>$92,575</td>
							</tr>
							<tr>
								<td>Jennifer Chang</td>
								<td>Regional Director</td>
								<td>Singapore</td>
								<td>28</td>
								<td>2010/11/14</td>
								<td>$357,650</td>
							</tr>
							<tr>
								<td>Brenden Wagner</td>
								<td>Software Engineer</td>
								<td>San Francisco</td>
								<td>28</td>
								<td>2011/06/07</td>
								<td>$206,850</td>
							</tr>
							<tr>
								<td>Fiona Green</td>
								<td>Chief Operating Officer (COO)</td>
								<td>San Francisco</td>
								<td>48</td>
								<td>2010/03/11</td>
								<td>$850,000</td>
							</tr>
							<tr>
								<td>Shou Itou</td>
								<td>Regional Marketing</td>
								<td>Tokyo</td>
								<td>20</td>
								<td>2011/08/14</td>
								<td>$163,000</td>
							</tr>
							<tr>
								<td>Michelle House</td>
								<td>Integration Specialist</td>
								<td>Sidney</td>
								<td>37</td>
								<td>2011/06/02</td>
								<td>$95,400</td>
							</tr>
							<tr>
								<td>Suki Burks</td>
								<td>Developer</td>
								<td>London</td>
								<td>53</td>
								<td>2009/10/22</td>
								<td>$114,500</td>
							</tr>
							<tr>
								<td>Prescott Bartlett</td>
								<td>Technical Author</td>
								<td>London</td>
								<td>27</td>
								<td>2011/05/07</td>
								<td>$145,000</td>
							</tr>
							<tr>
								<td>Gavin Cortez</td>
								<td>Team Leader</td>
								<td>San Francisco</td>
								<td>22</td>
								<td>2008/10/26</td>
								<td>$235,500</td>
							</tr>
							<tr>
								<td>Martena Mccray</td>
								<td>Post-Sales support</td>
								<td>Edinburgh</td>
								<td>46</td>
								<td>2011/03/09</td>
								<td>$324,050</td>
							</tr>
							<tr>
								<td>Unity Butler</td>
								<td>Marketing Designer</td>
								<td>San Francisco</td>
								<td>47</td>
								<td>2009/12/09</td>
								<td>$85,675</td>
							</tr>
							<tr>
								<td>Howard Hatfield</td>
								<td>Office Manager</td>
								<td>San Francisco</td>
								<td>51</td>
								<td>2008/12/16</td>
								<td>$164,500</td>
							</tr>
							<tr>
								<td>Hope Fuentes</td>
								<td>Secretary</td>
								<td>San Francisco</td>
								<td>41</td>
								<td>2010/02/12</td>
								<td>$109,850</td>
							</tr>
							<tr>
								<td>Vivian Harrell</td>
								<td>Financial Controller</td>
								<td>San Francisco</td>
								<td>62</td>
								<td>2009/02/14</td>
								<td>$452,500</td>
							</tr>
							<tr>
								<td>Timothy Mooney</td>
								<td>Office Manager</td>
								<td>London</td>
								<td>37</td>
								<td>2008/12/11</td>
								<td>$136,200</td>
							</tr>
							<tr>
								<td>Jackson Bradshaw</td>
								<td>Director</td>
								<td>New York</td>
								<td>65</td>
								<td>2008/09/26</td>
								<td>$645,750</td>
							</tr>
							<tr>
								<td>Olivia Liang</td>
								<td>Support Engineer</td>
								<td>Singapore</td>
								<td>64</td>
								<td>2011/02/03</td>
								<td>$234,500</td>
							</tr>
							<tr>
								<td>Bruno Nash</td>
								<td>Software Engineer</td>
								<td>London</td>
								<td>38</td>
								<td>2011/05/03</td>
								<td>$163,500</td>
							</tr>
							<tr>
								<td>Sakura Yamamoto</td>
								<td>Support Engineer</td>
								<td>Tokyo</td>
								<td>37</td>
								<td>2009/08/19</td>
								<td>$139,575</td>
							</tr>
							<tr>
								<td>Thor Walton</td>
								<td>Developer</td>
								<td>New York</td>
								<td>61</td>
								<td>2013/08/11</td>
								<td>$98,540</td>
							</tr>
							<tr>
								<td>Finn Camacho</td>
								<td>Support Engineer</td>
								<td>San Francisco</td>
								<td>47</td>
								<td>2009/07/07</td>
								<td>$87,500</td>
							</tr>
							<tr>
								<td>Serge Baldwin</td>
								<td>Data Coordinator</td>
								<td>Singapore</td>
								<td>64</td>
								<td>2012/04/09</td>
								<td>$138,575</td>
							</tr>
							<tr>
								<td>Zenaida Frank</td>
								<td>Software Engineer</td>
								<td>New York</td>
								<td>63</td>
								<td>2010/01/04</td>
								<td>$125,250</td>
							</tr>
							<tr>
								<td>Zorita Serrano</td>
								<td>Software Engineer</td>
								<td>San Francisco</td>
								<td>56</td>
								<td>2012/06/01</td>
								<td>$115,000</td>
							</tr>
							<tr>
								<td>Jennifer Acosta</td>
								<td>Junior Javascript Developer</td>
								<td>Edinburgh</td>
								<td>43</td>
								<td>2013/02/01</td>
								<td>$75,650</td>
							</tr>
							<tr>
								<td>Cara Stevens</td>
								<td>Sales Assistant</td>
								<td>New York</td>
								<td>46</td>
								<td>2011/12/06</td>
								<td>$145,600</td>
							</tr>
							<tr>
								<td>Hermione Butler</td>
								<td>Regional Director</td>
								<td>London</td>
								<td>47</td>
								<td>2011/03/21</td>
								<td>$356,250</td>
							</tr>
							<tr>
								<td>Lael Greer</td>
								<td>Systems Administrator</td>
								<td>London</td>
								<td>21</td>
								<td>2009/02/27</td>
								<td>$103,500</td>
							</tr>
							<tr>
								<td>Jonas Alexander</td>
								<td>Developer</td>
								<td>San Francisco</td>
								<td>30</td>
								<td>2010/07/14</td>
								<td>$86,500</td>
							</tr>
							<tr>
								<td>Shad Decker</td>
								<td>Regional Director</td>
								<td>Edinburgh</td>
								<td>51</td>
								<td>2008/11/13</td>
								<td>$183,000</td>
							</tr>
							<tr>
								<td>Michael Bruce</td>
								<td>Javascript Developer</td>
								<td>Singapore</td>
								<td>29</td>
								<td>2011/06/27</td>
								<td>$183,000</td>
							</tr>
							<tr>
								<td>Donna Snider</td>
								<td>Customer Support</td>
								<td>New York</td>
								<td>27</td>
								<td>2011/01/25</td>
								<td>$112,000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Forms -->
    	<!-- ============================================================== -->
		<div class="row gap-20 pos-r">
			<div class="masonry-item col-md-12">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Basic Form</h6>
					<div class="mT-30">
					<form>
						<div class="form-group">
							<label for="exampleInputEmail1">select2 example</label>
							<div class="single-slct">
								<select class="form-control select2">
									<option selected disabled>Gender</option>
									<option value="">Male</option>
									<option value="">Female</option>
								</select> 
								<span class="help-block"> Select your gender. </span> 
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="textareaexample">textarea example</label>
							<textarea name="textareaexample" class="form-control"></textarea>
						</div>
						<div class="checkbox checkbox-circle checkbox-info peers ai-c mB-15">
							<input type="checkbox" id="inputCall1" name="inputCheckboxesCall" class="peer">
							<label for="inputCall1" class=" peers peer-greed js-sb ai-c">
								<span class="peer peer-greed">Call John for Dinner</span>
							</label>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">ckEditor basic Example</label>
							<textarea id="tesCkeditor" name="tesCkeditor"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Complex Form Layout</h6>
					<div class="mT-30">
					<form>
						<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">
								Email
								<span class="required_label">*</span>
							</label>
							<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
						</div>
						<div class="form-group col-md-6">
							<label for="inputPassword4">Password</label>
							<input type="password" class="form-control" id="inputPassword4" placeholder="Password">
						</div>
						</div>
						<div class="form-group">
						<label for="inputAddress">Address</label>
						<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
						</div>
						<div class="form-group">
						<label for="inputAddress2">Address 2</label>
						<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
						</div>
						<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputCity">City</label>
							<input type="text" class="form-control" id="inputCity">
						</div>
						<div class="form-group col-md-4">
							<label for="inputState">State</label>
							<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>...</option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label for="inputZip">Zip</label>
							<input type="text" class="form-control" id="inputZip">
						</div>
						</div>
						<div class="form-row">
						<div class="form-group col-md-6">
							<label class="fw-500">Birthdate</label>
							<div class="timepicker-input input-icon form-group">
							<div class="input-group">
								<div class="input-group-addon bgc-white bd bdwR-0">
								<i class="ti-calendar"></i>
								</div>
								<input type="text" class="form-control bdc-grey-200 start-date" placeholder="Datepicker" data-provide="datepicker">
							</div>
							</div>
						</div>
						</div>
						<div class="form-group">
						<div class="checkbox checkbox-circle checkbox-info peers ai-c">
							<input type="checkbox" id="inputCall2" name="inputCheckboxesCall" class="peer">
							<label for="inputCall2" class=" peers peer-greed js-sb ai-c">
							<span class="peer peer-greed">Call John for Dinner</span>
							</label>
						</div>
						</div>
						<button type="submit" class="btn btn-primary">Sign in</button>
					</form>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Horizontal Form</h6>
					<div class="mT-30">
					<form>
						<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
						</div>
						</div>
						<div class="form-group row">
						<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
						</div>
						</div>
						<fieldset class="form-group">
						<div class="row">
							<legend class="col-form-legend col-sm-2">Radios</legend>
							<div class="col-sm-10">
							<div class="form-check">
								<label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
								Option one is this and that&mdash;be sure to include why it's great
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
								Option two can be something else and selecting it will deselect option one
								</label>
							</div>
							<div class="form-check disabled">
								<label class="form-check-label">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
								Option three is disabled
								</label>
							</div>
							</div>
						</div>
						</fieldset>
						<div class="form-group row">
						<div class="col-sm-2">Checkbox</div>
						<div class="col-sm-10">
							<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox"> Check me out
							</label>
							</div>
						</div>
						</div>
						<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary">Sign in</button>
						</div>
						</div>
					</form>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Disabled Forms</h6>
					<div class="mT-30">
					<form>
						<fieldset disabled>
						<div class="form-group">
							<label for="disabledTextInput">Disabled input</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
						</div>
						<div class="form-group">
							<label for="disabledSelect">Disabled select menu</label>
							<select id="disabledSelect" class="form-control">
							<option>Disabled select</option>
							</select>
						</div>
						<div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox"> Can't check this
							</label>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						</fieldset>
					</form>
					</div>
				</div>
			</div>
			<div class="masonry-item col-md-6">
				<div class="bgc-white p-20 bd">
					<h6 class="c-grey-900">Validation</h6>
					<div class="mT-30">
					<form class="container" id="needs-validation" novalidate>
						<div class="row">
						<div class="col-md-6 mb-3">
							<label for="validationCustom01">First name</label>
							<input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="validationCustom02">Last name</label>
							<input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
						</div>
						</div>
						<div class="row">
						<div class="col-md-6 mb-3">
							<label for="validationCustom03">City</label>
							<input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
							<div class="invalid-feedback">
							Please provide a valid city.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="validationCustom04">State</label>
							<input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
							<div class="invalid-feedback">
							Please provide a valid state.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="validationCustom05">Zip</label>
							<input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
							<div class="invalid-feedback">
							Please provide a valid zip.
							</div>
						</div>
						</div>
						<button class="btn btn-primary" type="submit">Submit form</button>
					</form>
					<script>
						// Example starter JavaScript for disabling form submissions if there are invalid fields
						(function() {
						'use strict';

						window.addEventListener('load', function() {
							var form = document.getElementById('needs-validation');
							form.addEventListener('submit', function(event) {
							if (form.checkValidity() === false) {
								event.preventDefault();
								event.stopPropagation();
							}
							form.classList.add('was-validated');
							}, false);
						}, false);
						})();
					</script>
					</div>
				</div>
			</div>
		</div>
		<div class="row gap-20 pos-r">
			<div class="masonry-sizer col-md-12"></div>
			<div class="masonry-item col-md-12">
				<div class="bgc-white p-20 bd">
					<h4 class="c-grey-900">Validation</h4>
					<div class="mT-30">
						<form id="needs-validation" novalidate>
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="validationCustom01">First name</label>
									<input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="validationCustom02">Last name</label>
									<input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="validationCustom03">City</label>
									<input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
									<div class="invalid-feedback">
										Please provide a valid city.
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="validationCustom04">State</label>
									<input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
									<div class="invalid-feedback">
										Please provide a valid state.
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<label for="validationCustom05">Zip</label>
									<input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
									<div class="invalid-feedback">
										Please provide a valid zip.
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="inputCity">City</label>
									<input type="text" class="form-control" id="inputCity" required>
								</div>
								<div class="form-group col-md-4">
									<label for="inputState">State</label>
									<select id="inputState" class="form-control">
										<option selected>Choose...</option>
										<option>...</option>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="inputZip">Zip</label>
									<input type="text" class="form-control" id="inputZip">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label class="fw-500">Birthdate</label>
									<div class="timepicker-input input-icon form-group">
										<div class="input-group">
											<div class="input-group-addon bgc-white bd bdwR-0">
												<i class="ti-calendar"></i>
											</div>
											<input type="text" class="form-control bdc-grey-200 start-date" placeholder="Datepicker" data-provide="datepicker">
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group">
									<div class="checkbox checkbox-circle checkbox-info peers ai-c">
										<input type="checkbox" id="inputCall2" name="inputCheckboxesCall" class="peer">
										<label for="inputCall2" class=" peers peer-greed js-sb ai-c">
											<span class="peer peer-greed">Call John for Dinner</span>
										</label>
									</div>
								</div>
							</div>
							<button class="btn btn-primary" type="submit">Submit form</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTableExample').DataTable({
				responsive: true,
				scrollX: true,
				language: {
					search: '<i class="fas fa-search" aria-hidden="true"></i>',
					searchPlaceholder: 'Search Order'
				}
			});
		});

		$('#sa-test').click(function(){
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover this imaginary file!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel pls!",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            }, function(isConfirm){   
                if (isConfirm) {     
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");   
                } else {     
                    swal("Cancelled", "Your imaginary file is safe :)", "error");   
                } 
            });
		});
		
		$("#tesmodal").click(function(){
            $("#exampleModal").modal('show');
        });

		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';

			window.addEventListener('load', function() {
				var form = document.getElementById('needs-validation');
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			}, false);
		})();
	</script>
@endpush