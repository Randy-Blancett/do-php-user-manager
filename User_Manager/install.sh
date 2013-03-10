echo "Remove all prior files"
rm -Rf dist/*
phing pear-package
pear uninstall darkowls/User_Manager
pear install dist/*.tgz
