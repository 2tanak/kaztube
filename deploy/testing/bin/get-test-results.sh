JOB_NAME=$1
NS=${KUBE_NAMESPACE:-${CI_PROJECT_NAME}}

testCode=1
while [ "$testCode" -eq "1" ]
do
  kubectl exec -n $NS job.batch/$JOB_NAME -c php -- test -f dusk-status > /dev/null
  testCode=$?
  sleep 10
done

POD_NAME=$(kubectl get pods -n $NS --selector=job-name=$JOB_NAME --no-headers -o custom-columns=":metadata.name")

cp_from_job () {
  kubectl cp -n $NS $POD_NAME:$1 $2 -c php
}

echo "saving test results"
cp_from_job /code/dusk.log dusk.log
cp_from_job /code/dusk-status dusk-status

mkdir tmp

cp_from_job /code/tests/Browser/screenshots tmp/screenshots
cp_from_job /code/tests/Browser/console tmp/console

cat dusk.log

DUSK_STATUS=$(cat dusk-status)

exit $DUSK_STATUS
