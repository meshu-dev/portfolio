<script setup>
  import ProjectTypeSelector from '@/components/Project/ProjectTypeSelector'
  import ProjectList from '@/components/Project/ProjectList'
  import { login } from '@/services/auth'
  import { getTypes } from '@/services/type'
  import { getProjects } from '@/services/project'

  const authData = await login()

  let types    = []
  let projects = []

  console.log('authData', authData)

  if (authData?.token) {
    types = await getTypes(authData.token)
    projects = await getProjects(authData.token)
  }
</script>

<template>
  <ProjectTypeSelector :types="types" />
  <ProjectList :projects="projects" />
</template>
