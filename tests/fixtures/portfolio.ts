import type { Livestream, PortfolioResponse } from '~/types/Portfolio'
import { LivestreamStatus } from '~/enums/LivestreamStatus'

export const makeLivestream = (overrides: Partial<Livestream> = {}): Livestream => ({
  title: 'Coding with Claude AI',
  description: 'Building a small Node app that talks to the Gemini API.',
  url: 'https://www.youtube.com/watch?v=abc123',
  thumbnail: 'https://i.ytimg.com/vi/abc123/hqdefault.jpg',
  status: LivestreamStatus.Completed,
  scheduled_start_at: '2026-10-12T17:30:00Z',
  actual_start_at: '2026-10-12T17:33:00Z',
  actual_end_at: '2026-10-12T19:45:00Z',
  ...overrides
})

export const makePortfolio = (overrides: Partial<PortfolioResponse['data']> = {}): PortfolioResponse => ({
  data: {
    intro: {
      image: '',
      line1: "Hello, I'm Alex",
      line2: "I'm a software developer with 16 years of experience",
      sites: [
        { name: 'GitHub', url: 'https://github.com/example', icon: 'i-simple-icons-github', image_url: '' },
        { name: 'YouTube', url: 'https://www.youtube.com/@Mesh-Pro', icon: 'i-simple-icons-youtube', image_url: '' }
      ]
    },
    about: {
      image_url: 'https://placehold.co/640x800',
      text: '<p>I am a full-stack developer.</p><p>I enjoy solving practical problems.</p>',
      technologies: ['PHP', 'Laravel', 'TypeScript']
    },
    projects: [
      {
        name: 'Starter Portfolio',
        description: 'Personal portfolio template',
        url: 'https://portfolio.example.com',
        image_url: 'https://placehold.co/960x600',
        repositories: [
          { name: 'Starter Portfolio', url: 'https://github.com/example/starter-portfolio' },
          { name: 'Starter API', url: 'https://github.com/example/starter-api' }
        ],
        technologies: ['React', 'Next.js', 'Laravel']
      },
      {
        name: 'Learning Lab',
        description: 'Tutorial and notes platform',
        url: 'https://lab.example.com',
        image_url: 'https://placehold.co/960x600',
        repositories: [{ name: 'Learning Lab', url: 'https://github.com/example/learning-lab' }],
        technologies: ['Astro', 'Laravel']
      }
    ],
    ...overrides
  }
})
