<div id="Sidebar">
	<div class="sidebarTop"></div>
	<% include Sidebar_Cart %>
	<div class="sidebarBottom"></div>
</div>
<div id="ProductGroup" class="mainSection">
	$Content
	<% if TopLevelGroups %>
		<ul class="ULgroups level1">
		<% control TopLevelGroups %>
			<li class="groupItem">
				<a href="$Link" class="groupLink" rel="$ID">$Title</a>
			<% if DirectChildProducts %>
				<ul class="ULproducts level2">
				<% control DirectChildProducts %>
					<li class="productItem">
						<a href="$AjaxLink" class="productLink" rel="MoreInfo$ID">$Title</a>
						<div class="productActionsOuter">
							<div id="MoreInfo$ID" class="moreInfoHolder"></div>
						</div>
					</li>
				<% end_control %>
				</ul>
			<% end_if %>
			<% if DirectChildGroups %>
				<ul class="ULgroups level2">
				<% control DirectChildGroups %>
					<li class="groupItem">
						<a href="$Link" class="groupLink" rel="$ID">$Title</a>
					<% if DirectChildProducts %>
						<ul class="ULproducts level3">
						<% control DirectChildProducts %>
							<li class="productItem">
								<a href="$AjaxLink" class="productLink" rel="MoreInfo$ID">$Title</a>
								<div class="productActionsOuter">
									<div id="MoreInfo$ID" class="moreInfoHolder"></div>
								</div>
							</li>
						<% end_control %>
						</ul>
					<% end_if %>
					<% if DirectChildGroups %>
						<ul class="ULgroups level3">
						<% control DirectChildGroups %>
							<li class="groupItem">
								<a href="$Link" class="groupLink" rel="$ID">$Title</a>
							<% if DirectChildProducts %>
								<ul class="ULproducts level4">
								<% control DirectChildProducts %>
									<li class="productItem">
										<a href="$AjaxLink" class="productLink" rel="MoreInfo$ID">$Title</a>
										<div class="productActionsOuter">
											<div id="MoreInfo$ID" class="moreInfoHolder"></div>
										</div>
									</li>
								<% end_control %>
								</ul>
							<% end_if %>
							<% if DirectChildGroups %>
								<ul class="ULgroups level4">
								<% control DirectChildGroups %>
									<li class="groupItem">
										<a href="$Link" class="groupLink" rel="$ID">$Title</a>
									<% if DirectChildProducts %>
										<ul class="ULproducts level5">
										<% control DirectChildProducts %>
											<li class="productItem">
												<a href="$AjaxLink" class="productLink" rel="MoreInfo$ID">$Title</a>
												<div class="productActionsOuter">
													<div id="MoreInfo$ID" class="moreInfoHolder"></div>
												</div>
											</li>
										<% end_control %>
										</ul>
									<% end_if %>
									<% if DirectChildGroups %>
										<ul class="ULgroups level5">
										<% control DirectChildGroups %>
											<li class="groupItem">
												<a href="$Link" class="groupLink" rel="$ID">$Title</a>
											<% if DirectChildProducts %>
												<ul class="ULproducts level6">
												<% control DirectChildProducts %>
													<li class="productItem">
														<a href="$AjaxLink" class="productLink" rel="MoreInfo$ID">$Title</a>
														<div class="productActionsOuter">
															<div id="MoreInfo$ID" class="moreInfoHolder"></div>
														</div>
													</li>
												<% end_control %>
												</ul>
											<% end_if %>
											</li>
										<% end_control %>
										</ul>
									<% end_if %>
									</li>
								<% end_control %>
								</ul>
							<% end_if %>
							</li>
						<% end_control %>
						</ul>
					<% end_if %>
					</li>
				<% end_control %>
				</ul>
			<% end_if %>
			</li>
		<% end_control %>
		</ul>
	<% end_if %>
	<% if EcomConfig.CheckoutLink %>
	<p id="CheckoutLink">
		<a href="$EcomConfig.CheckoutLink">Continue to Checkout</a>
	</p>
	<% end_if %>

	$Form
</div>
