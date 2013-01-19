Ext.define('darkowl.userManager.user.addEdit.cTopForm', {
	extend : 'Ext.form.Panel',
	layout : 'fit',
	// frame : true,
	border : false,
	requires : [ 'darkowl.userManager.user.addEdit.cTabForm' ],
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Tabs = Ext
				.create('darkowl.userManager.user.addEdit.cTabForm');

		this.m_obj_Submit = Ext.create('Ext.button.Button', {
			text : 'Submit',
			formBind : true,
			handler : function() {
				alert('You clicked the button!');
			}
		});

		this.buttons = [];

		this.buttons.push(this.m_obj_Submit);

		this.callParent();

		this.add(this.m_obj_Tabs);
	}
});