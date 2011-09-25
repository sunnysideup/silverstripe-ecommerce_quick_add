<div id="Sidebar">
	<% include Sidebar_Cart %>
</div>
<div id="ProductGroup">
	$Content
	<% if TopLevelGroups %>
		<ul class="ULgroups">
		<% control TopLevelGroups %>
			<li class="groupItem">
				<a href="$Link" class="groupLink" rel="$ID">$Title</a>
			<% if DirectChildProducts %>
				<ul class="ULproducts">
				<% control DirectChildProducts %>
					<li class="productItem">
						<a href="$Link" class="productLink" rel="$ID">$Title</a>
						<div class="productActionsOuter"><% include ProductActions %></div>
					</li>
				<% end_control %>
				</ul>
			<% end_if %>
			<% if DirectChildGroups %>
				<ul class="ULgroups">
				<% control DirectChildGroups %>
					<li class="groupItem">
						<a href="$Link" class="groupLink" rel="$ID">$Title</a>
					<% if DirectChildProducts %>
						<ul class="ULproducts">
						<% control Products %>
							<li class="productItem">
								<a href="$link" class="productLink" rel="$ID">$Title</a>
								<div class="productActionsOuter"><% include ProductActions %></div>
							</li>
						<% end_control %>
						</ul>
					<% end_if %>
					<% if DirectChildGroups %>
						<ul class="ULgroups">
						<% control DirectChildGroups %>
							<li class="groupItem">
								<a href="$Link" class="groupLink" rel="$ID">$Title</a>
							<% if DirectChildProducts %>
								<ul class="ULproducts">
								<% control Products %>
									<li class="productItem">
										<a href="$link" class="productLink" rel="$ID">$Title</a>
										<div class="productActionsOuter"><% include ProductActions %></div>
									</li>
								<% end_control %>
								</ul>
							<% end_if %>
							<% if DirectChildGroups %>
								<ul class="ULgroups">
								<% control DirectChildGroups %>
									<li class="groupItem">
										<a href="$Link" class="groupLink" rel="$ID">$Title</a>
									<% if DirectChildProducts %>
										<ul class="ULproducts">
										<% control Products %>
											<li class="productItem">
												<a href="$link" class="productLink" rel="$ID">$Title</a>
												<div class="productActionsOuter"><% include ProductActions %></div>
											</li>
										<% end_control %>
										</ul>
									<% end_if %>
									<% if DirectChildGroups %>
										<ul class="ULgroups">
										<% control DirectChildGroups %>
											<li class="groupItem">
												<a href="$Link" class="groupLink" rel="$ID">$Title</a>
											<% if DirectChildProducts %>
												<ul class="ULproducts">
												<% control Products %>
													<li class="productItem">
														<a href="$link" class="productLink" rel="$ID">$Title</a>
														<div class="productActionsOuter"><% include ProductActions %></div>
													</li>
												<% end_control %>
												</ul>
											<% end_if %>
											<% if DirectChildGroups %>
												<ul class="ULgroups">
												<% control DirectChildGroups %>
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
	<% if CheckoutLink %>
	<p id="CheckoutLink">
		<a href="$CheckoutLink">Continue to Checkout</a>
	</p>
	<% end_if %>

	$Form
</div>
