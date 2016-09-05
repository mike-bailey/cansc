#!/bin/bash

args=( "$@" )
FOLDERSESSION=$RANDOM$RANDOM$RANDOM$RANDOM
mkdir pdfs/massrequest_$FOLDERSESSION
for i in ${args[@]}; do
	SESSION=$RANDOM$RANDOM$RANDOM
	 wkhtmltopdf "https://cansc.michaelbailey.co/genprofile.php?nonotes&profile=$i" pdfs/massrequest_$FOLDERSESSION/massrequest_$SESSION.pdf &> /dev/null
done
SESSION=$RANDOM$RANDOM$RANDOM
pdfunite pdfs/massrequest_$FOLDERSESSION/* pdfs/out_$SESSION.pdf &> /dev/null
echo -n out_$SESSION.pdf
