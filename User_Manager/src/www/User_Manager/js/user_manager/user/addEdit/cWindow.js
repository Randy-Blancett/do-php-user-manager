Ext.define('darkowl.userManager.user.addEdit.cWindow', {
	extend : 'darkowl.desktop.cDesktopWindow',
	title : "Add/Edit Users",
	iconCls : "window-user-add-icon",
	requires : [ 'darkowl.userManager.user.addEdit.cTopForm' ],
	uses : [],
	width : 700,
	height : 390,
	shim : false,
	animCollapse : false,
	constrain : true,
	m_str_ID : "",
	layout : "fit",
	border : false,
	resizable : false,
	m_obj_Mask : null,

	initComponent : function() {
		var obj_This = this;

		this.m_obj_Form = Ext
				.create('darkowl.userManager.user.addEdit.cTopForm');

		this.callParent();

		this.add(this.m_obj_Form);

		if (this.m_str_ID) {
			this.showMask();
			this.loadUser(this.m_str_ID);
		}
		this.on("afterrender", function() {
			if (this.m_bool_Mask) {
				this.showMask();
			}
		});
	},
	loadUser : function(str_ID) {
		this.m_obj_Form.load({
			headers : {
				Accept : "application/json"
			},
			url : "../rest/user/" + str_ID,
			method : "get",
			success : function(obj_Form, obj_User) {
				this.hideMask();
			},
			failure : function() {
				this.hideMask();
			},
			scope : this
		});
		
		this.m_obj_Form.loadUser(str_ID);
	},
	showMask : function() {
		this.m_bool_Mask = true;
		if (this.getEl()) {
			if (!this.m_obj_Mask) {
				this.m_obj_Mask = new Ext.LoadMask(this.getEl(), {
					msg : "Loading Data..."
				});
			}
			this.m_obj_Mask.show();
		}
	},
	hideMask : function() {
		this.m_bool_Mask = true;
		if (this.getEl()) {
			if (!this.m_obj_Mask) {
				return;
			}
			this.m_obj_Mask.hide();
		}
	}
});
