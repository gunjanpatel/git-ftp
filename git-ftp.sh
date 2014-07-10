#!/bin/sh

IFS="="
while read -r name value
do
	# Fetch username
	if [ "$name" = "username" ]; then
		USERNAME=${value}
	fi

	# Fetch password
	if [ "$name" = "password" ]; then
		PASSWORD=${value}
	fi

	# Fetch hostname
	if [ "$name" = "hostname" ]; then
		HOSTNAME=${value}
	fi

	# Fetch hostname
	if [ "$name" = "remotepath" ]; then
		REMOTEPATH=${value}
	fi

	# Fetch hostname
	if [ "$name" = "repodir" ]; then
		REPODIR=${value}
	fi
done < ftpdata

# Start ftp upload and git

cd $REPODIR

git pull --no-edit

git ftp push --user $USERNAME --passwd $PASSWORD $HOSTNAME$REMOTEPATH
