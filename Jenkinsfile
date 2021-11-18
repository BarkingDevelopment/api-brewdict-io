#!groovy
pipeline {
    agent any

    stages {
        stage("Build") {
            steps {
              sh "docker-compose build mlbarker/brewdict-api:${env.BUILD_ID}"
              sh "docker tag mlbarker/brewdict-api:${env.BUILD_ID} mlbarker/brewdict-api:latest"
            }
        }
    }
}
