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
	layout : "fit",
	border : false,
	resizable : false,

	initComponent : function() {
		var obj_This = this;

		this.m_obj_Form = Ext
				.create('darkowl.userManager.user.addEdit.cTopForm');

		this.callParent();

		this.add(this.m_obj_Form);
	}
});
