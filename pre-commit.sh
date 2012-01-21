#!/bin/sh
#
# This will create a file "version.txt" with the version of the **previous*** commit
#
# Must be symlinked/copied to .git/hooks/pre-commit

#myDir=administrator/components/com_easycreator

git describe --long > version.txt

git add version.txt
