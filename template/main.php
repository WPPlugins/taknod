<div class="container-fluid" ng-app="taknodeApp"  ng-init='pr.apiKey="%s";plan=%s'>
	<div class="row">
		<div class=" col-md-12 col-lg-12" ng-view>

			<div class="sk-fading-circle">
				<div class="sk-circle1 sk-circle"></div>
				<div class="sk-circle2 sk-circle"></div>
				<div class="sk-circle3 sk-circle"></div>
				<div class="sk-circle4 sk-circle"></div>
				<div class="sk-circle5 sk-circle"></div>
				<div class="sk-circle6 sk-circle"></div>
				<div class="sk-circle7 sk-circle"></div>
				<div class="sk-circle8 sk-circle"></div>
				<div class="sk-circle9 sk-circle"></div>
				<div class="sk-circle10 sk-circle"></div>
				<div class="sk-circle11 sk-circle"></div>
				<div class="sk-circle12 sk-circle"></div>
			</div>
		</div>
	</div>

<script type="text/ng-template" id="main.tpl">
		<div class="row">
			<div class="  col-md-12 col-lg-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th ng-show="plan">محصول</th>
							<th ng-show="price">نوع لایسنس</th>
							<th ng-show="year">دوره زمانی</th>
							<th ng-show="perUser">تعداد کاربر</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div ng-repeat="(key, p) in plan.price">
									<div ng-repeat="(prId, pro) in p">
										<div class="radio" >
											<label>
												<input type="radio" name="pro" ng-click="setPrice(pro.price,prId)" ng-model='pr.product' value='{{prId}}'>
												{{pro.name}}
											</label>
										</div>
									</div>
								</div>
							</td>
							<td ng-show="price">
								<div class="radio" ng-repeat="(key, pr) in price">
									<label>
										<input type="radio" name="prType" ng-click="setYear(key)" ng-checked="key=='new'">
										{{key=='new' ? 'لایسنس جدید' : 'تمدید لایسنس'}}
									</label>
								</div>
							</td>

							<td ng-show="year">
								<div class="radio" ng-repeat="(key, per) in year">
									<label>
										<input type="radio" name="per" ng-click="setPerUser(per,key)" ng-model="pr.year" value="{{key}}">
										{{key}} ساله
									</label>
								</div>
							</td>
							<td ng-show="perUser">
								<div class="form-group">
									<select  class="form-control" >
										<option ng-repeat="(key, licPrice) in perUser" ng-click="calcPrice(licPrice,key)" value="{{key}}" ng-model="pr.quantity">{{key}} کاربره</option>
									</select>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row" ng-show="finalPrice" >
			<div class="col-md-6 col-lg-6" >
				<b>
				قیمت محصول {{finalPrice | currency:'':0}} تومان
				</b>
				<form class="form-horizontal" name="infoFrm" >

					<div class="form-group">
						<label for="inputFname" class=" control-label">نام:</label>
						<input type="text" ng-model="pr.fname" id="inputFname" class="form-control"  required="required"  >
					</div>
					<div class="form-group">
						<label for="inputLname" class=" control-label">نام خانوادگی:</label>
						<input type="text" ng-model="pr.lname" id="inputLname" class="form-control"  required="required"  >
					</div>
					<div class="form-group">
						<label for="email">ایمیل</label>
						<input type="email" class="form-control" id="email" placeholder="آدرس ایمیل برای دریافت اطلاعات لایسنس" ng-model='pr.email'>
					</div>
					<div class="form-group">
						<label for="inputMob" class=" control-label">موبایل:</label>
						<input type="text" ng-model="pr.mobile" id="inputMob" class="form-control"  required="required" placeholder="شماره موبایل برای دریافت اطلاعات لایسنس" >
					</div>
					<div ng-show="pr.type=='reNew'">
						<span class="help-block">
							اطلاعات تمدید لایسنس
						</span>

						<div class="form-group">
							<label for="inpUname" class=" control-label">نام کاربری لایسنس:</label>
							<input type="text" ng-model="pr.lic_username" id="inpUname" class="form-control">
						</div>
						<div class="form-group">
							<label for="inpPass" class=" control-label">پسورد لایسنس:</label>
							<input type="text" ng-model="pr.lic_password" id="inpPass" class="form-control">
						</div>

					</div>
					<button class="btn btn-primary" ng-click="esLicReq()"
						ng-disabled="infoFrm.$invalid">خرید</button>
				</form>

			</div>
			<div class=" col-md-6 col-lg-6">

				<h5>*راهنما</h5>
				<ul style="margin-right: 5px;">
						اطلاعات لایسنس از سه طریق در اختیار شما قرار خواهد گرفت
						<li>ایمیل     : توسط سایت نود</li>
						<li>پیامک     : توسط ما</li>
						<li>صفحه خرید : توسط همین وب سایت و در صفحه خرید</li>
					</ul>
			</div>
			</div>

		</div>

</script>
</div>
