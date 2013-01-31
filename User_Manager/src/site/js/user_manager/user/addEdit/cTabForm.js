Ext.define('darkowl.userManager.user.addEdit.cTabForm', {
	requires : [ 'darkowl.userManager.user.addEdit.tabs.cAccountInfo',
			'darkowl.userManager.user.addEdit.tabs.cComments',
			'darkowl.userManager.user.addEdit.tabs.cGroups' ],
	extend : 'Ext.tab.Panel',
	// frame : true,
	border : false,
	activeTab : 0,
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Tab_Account = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cAccountInfo');
		this.m_obj_Tab_ContactInfo = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cContactInfo');
		this.m_obj_Tab_Stats = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cStats');
		this.m_obj_Tab_UserInfo = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cUserInfo');
		this.m_obj_Tab_Groups = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cGroups');
		this.m_obj_Tab_Comments = Ext
				.create('darkowl.userManager.user.addEdit.tabs.cComments');

		this.callParent();
		this.add(this.m_obj_Tab_Account);
		this.add(this.m_obj_Tab_UserInfo);
		this.add(this.m_obj_Tab_ContactInfo);
		this.add(this.m_obj_Tab_Stats);
		this.add(this.m_obj_Tab_Comments);
		this.add(this.m_obj_Tab_Groups);
	},
	getUserID : function() {
		return this.m_obj_Tab_Account.getUserID();
	},
	loadUser : function(str_ID) {
		this.m_obj_Tab_Groups.loadUser(str_ID);
	}
});