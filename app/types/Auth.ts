export type AuthResponse = {
  data: {
    token: string
  }
}

export type AuthPayload = {
  email: string
  password: string
}
