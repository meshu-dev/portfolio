import type { LivestreamStatus } from '~/enums/LivestreamStatus'

export type PortfolioResponse = {
  data: {
    intro: Intro
    about: About
    projects: Project[]
  }
}

export type Repository = {
  name: string
  url: string
}

export type Intro = {
  image: string
  line1: string
  line2: string
  sites: IntroSite[]
}

export type IntroSite = {
  name: string
  url: string
  icon: string
  image_url: string
}

export type About = {
  image_url: string
  text: string
  technologies: string[]
}

export type Project = {
  name: string
  description: string
  url: string
  image_url: string
  repositories: Repository[]
  technologies: string[]
}

export type LivestreamsResponse = {
  data: Livestream[]
}

export type LastStreamedResponse = {
  data: Livestream | null
}

export type Livestream = {
  title: string
  description: string
  url: string
  thumbnail: string | null
  status: LivestreamStatus
  scheduled_start_at: string | null
  actual_start_at: string | null
  actual_end_at: string | null
}
