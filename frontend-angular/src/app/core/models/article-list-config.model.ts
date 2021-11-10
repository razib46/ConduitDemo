export interface ArticleListConfig {
  type: string;

  filters: {
    tag?: string,
    author?: string,
    favorited?: string,
    limit?: number,
    offset?: number,
    relevant?: number,
    relevantlimit?: number,
    expect?: number[]
  };
}
